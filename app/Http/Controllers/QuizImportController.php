<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizImportController extends Controller
{
    public function showForm()
    {
        return view('admin.quizzes_import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|file|max:51200', // increased to 50MB for large imports
        ]);

        try {
            set_time_limit(300); // allow up to 5 minutes for large imports
            $file = $request->file('csv');
            $path = $file->getRealPath();

            // Read file content
            $content = file_get_contents($path);

            // Detect and convert encoding to UTF-8
            if (substr($content, 0, 2) === "\xFF\xFE") {
                // UTF-16 LE with BOM
                $content = mb_convert_encoding(substr($content, 2), 'UTF-8', 'UTF-16LE');
            } elseif (substr($content, 0, 2) === "\xFE\xFF") {
                // UTF-16 BE with BOM
                $content = mb_convert_encoding(substr($content, 2), 'UTF-8', 'UTF-16BE');
            } else {
                // Strip UTF-8 BOM if present
                $content = preg_replace('/^\xEF\xBB\xBF/', '', $content);
                // Only convert if clearly NOT UTF-8 (strict check)
                // mb_check_encoding can give false negatives on valid UTF-8 with special chars,
                // so we use iconv as a double-check before converting
                if (!mb_check_encoding($content, 'UTF-8')) {
                    $converted = @iconv('Windows-1252', 'UTF-8//IGNORE', $content);
                    // Only use converted version if iconv succeeded and result is valid UTF-8
                    if ($converted !== false && mb_check_encoding($converted, 'UTF-8')) {
                        $content = $converted;
                    }
                    // Otherwise leave as-is and let MySQL handle it
                }
            }

            // Normalize line endings
            $content = str_replace(["\r\n", "\r"], "\n", $content);

            $lines = array_values(array_filter(array_map('trim', explode("\n", $content))));

            if (empty($lines)) {
                return back()->with('error', 'CSV file is empty.');
            }

            // Parse header
            $headerLine = array_shift($lines);
            $header = array_map(fn($h) => trim(preg_replace('/^\xEF\xBB\xBF/', '', $h)), str_getcsv($headerLine));

            Log::info('CSV Import', ['header' => $header, 'line_count' => count($lines)]);

            $requiredColumns = ['quiz_title', 'question_text', 'question_type', 'option_1', 'option_2', 'correct_choice_index'];
            $missingColumns = array_diff($requiredColumns, $header);
            if (!empty($missingColumns)) {
                return back()->with('error', 'Missing required columns: ' . implode(', ', $missingColumns) . '. Your CSV has: [' . implode(', ', array_filter($header)) . ']. Please download the template and use it.');
            }

            $hasSubjectId   = in_array('subject_id', $header);
            $hasSubjectName = in_array('subject_name', $header);
            $hasModuleId    = in_array('module_id', $header);
            $hasModuleName  = in_array('module_name', $header);
            $hasCourseName  = in_array('course_name', $header);

            if (!($hasSubjectId || $hasSubjectName)) {
                return back()->with('error', 'CSV must have either "subject_id" or "subject_name" column.');
            }
            if (!($hasModuleId || $hasModuleName)) {
                return back()->with('error', 'CSV must have either "module_id" or "module_name" column.');
            }

            // Pre-load all subjects and modules into memory to avoid per-row queries
            $subjectCache = $hasSubjectName
                ? \App\Models\Subject::pluck('id', 'title')->toArray()
                : [];
            $moduleCache = $hasModuleName
                ? \App\Models\Module::pluck('id', 'title')->toArray()
                : [];
            $courseCache = \App\Models\Course::pluck('id', 'title')->toArray();

            // Fallback course: first available
            $defaultCourseId = \App\Models\Course::value('id');

            // Quiz cache: "title|module_id|subject_id" => quiz_id
            $quizCache = [];

            DB::beginTransaction();

            $importedQuestions = 0;
            $skippedRows = 0;
            $skipReasons = [];
            $chunkSize = 200;

            // Collect parsed rows first
            $parsedRows = [];
            foreach ($lines as $lineNum => $line) {
                $line = trim($line);
                if (empty($line)) { $skippedRows++; continue; }

                $values = array_map('trim', str_getcsv($line));
                while (count($values) < count($header)) { $values[] = ''; }
                $row = array_combine($header, array_slice($values, 0, count($header)));

                if (empty($row['quiz_title']) || empty($row['question_text'])) {
                    $skippedRows++;
                    $skipReasons[] = "Row " . ($lineNum + 2) . ": missing quiz_title or question_text";
                    continue;
                }

                // Resolve subject — auto-create if not found
                $subjectId = null;
                if ($hasSubjectId && !empty($row['subject_id'])) {
                    $subjectId = (int)$row['subject_id'];
                } elseif ($hasSubjectName && !empty($row['subject_name'])) {
                    $name = trim($row['subject_name']);
                    if (!isset($subjectCache[$name])) {
                        // Resolve course for the new subject
                        $courseId = $defaultCourseId;
                        if ($hasCourseName && !empty($row['course_name'])) {
                            $courseName = trim($row['course_name']);
                            if (!isset($courseCache[$courseName])) {
                                $newCourse = \App\Models\Course::create(['title' => $courseName]);
                                $courseCache[$courseName] = $newCourse->id;
                            }
                            $courseId = $courseCache[$courseName];
                        }
                        $newSubject = \App\Models\Subject::create([
                            'title'     => $name,
                            'course_id' => $courseId,
                        ]);
                        $subjectCache[$name] = $newSubject->id;
                        Log::info("Auto-created subject: {$name} (id={$newSubject->id})");
                    }
                    $subjectId = $subjectCache[$name];
                }

                // Resolve module — auto-create if not found
                $moduleId = null;
                if ($hasModuleId && !empty($row['module_id'])) {
                    $moduleId = (int)$row['module_id'];
                } elseif ($hasModuleName && !empty($row['module_name'])) {
                    $name = trim($row['module_name']);
                    if (!isset($moduleCache[$name])) {
                        $newModule = \App\Models\Module::create([
                            'title'      => $name,
                            'subject_id' => $subjectId,
                            'status'     => 'active',
                        ]);
                        $moduleCache[$name] = $newModule->id;
                        Log::info("Auto-created module: {$name} (id={$newModule->id})");
                    }
                    $moduleId = $moduleCache[$name];
                }

                if (!$subjectId || !$moduleId) {
                    $skippedRows++;
                    $skipReasons[] = "Row " . ($lineNum + 2) . ": could not resolve subject_id or module_id (values: subject=" . ($row['subject_id'] ?? $row['subject_name'] ?? 'n/a') . ", module=" . ($row['module_id'] ?? $row['module_name'] ?? 'n/a') . ")";
                    continue;
                }

                $parsedRows[] = compact('row', 'subjectId', 'moduleId');
            }

            // Process in chunks
            foreach (array_chunk($parsedRows, $chunkSize) as $chunk) {
                $questionsToInsert = [];
                $choicesBuffer     = []; // keyed by temp index, holds [choices] + question index

                // Ensure quizzes exist (firstOrCreate with cache)
                foreach ($chunk as $item) {
                    ['row' => $row, 'subjectId' => $subjectId, 'moduleId' => $moduleId] = $item;
                    $quizKey = trim($row['quiz_title']) . '|' . $moduleId . '|' . $subjectId;

                    if (!isset($quizCache[$quizKey])) {
                        $quiz = Quiz::firstOrCreate(
                            ['title' => trim($row['quiz_title']), 'module_id' => $moduleId, 'subject_id' => $subjectId],
                            ['description' => !empty($row['quiz_description']) ? trim($row['quiz_description']) : null]
                        );
                        $quizCache[$quizKey] = $quiz->id;
                    }
                }

                // Build questions insert array
                foreach ($chunk as $idx => $item) {
                    ['row' => $row, 'subjectId' => $subjectId, 'moduleId' => $moduleId] = $item;
                    $quizKey = trim($row['quiz_title']) . '|' . $moduleId . '|' . $subjectId;

                    $questionsToInsert[] = [
                        'quiz_id'             => $quizCache[$quizKey],
                        'question_text'       => trim($row['question_text']),
                        'question_type'       => !empty($row['question_type']) ? trim($row['question_type']) : 'multiple_choice',
                        'correct_description' => !empty($row['rationale']) ? trim($row['rationale']) : null,
                        'notes'               => !empty($row['notes']) ? trim($row['notes']) : null,
                    ];

                    $choicesBuffer[$idx] = [
                        'correct_index' => (int)$row['correct_choice_index'],
                        'options'       => array_filter([
                            1 => $row['option_1'] ?? '',
                            2 => $row['option_2'] ?? '',
                            3 => $row['option_3'] ?? '',
                            4 => $row['option_4'] ?? '',
                        ], fn($v) => $v !== ''),
                    ];
                }

                // Bulk insert questions and retrieve their IDs via lastInsertId range
                // MySQL lastInsertId() returns the FIRST auto-increment ID of a bulk insert
                $insertedCount = count($questionsToInsert);
                Question::insert($questionsToInsert);

                $firstId     = (int) DB::getPdo()->lastInsertId();
                $questionIds = range($firstId, $firstId + $insertedCount - 1);

                // Build choices bulk insert
                $choicesToInsert = [];
                foreach ($questionIds as $qIdx => $questionId) {
                    $buf = $choicesBuffer[$qIdx];
                    foreach ($buf['options'] as $optNum => $optText) {
                        $choicesToInsert[] = [
                            'question_id' => $questionId,
                            'choice_text' => trim($optText),
                            'is_correct'  => ($buf['correct_index'] === ($optNum - 1)) ? 1 : 0,
                        ];
                    }
                }

                if (!empty($choicesToInsert)) {
                    // Insert choices in sub-chunks to avoid hitting DB placeholder limits
                    foreach (array_chunk($choicesToInsert, 500) as $choiceChunk) {
                        Choice::insert($choiceChunk);
                    }
                }

                $importedQuestions += $insertedCount;
            }

            DB::commit();

            $message = "Successfully imported $importedQuestions questions.";
            if ($skippedRows > 0) {
                $message .= " Skipped $skippedRows rows.";
                if (!empty($skipReasons)) {
                    $message .= " Reasons: " . implode('; ', array_slice($skipReasons, 0, 5));
                    if (count($skipReasons) > 5) {
                        $message .= ' ... and ' . (count($skipReasons) - 5) . ' more.';
                    }
                }
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Quiz import failed: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    public function downloadTemplate(Request $request)
    {
        $type = $request->get('type', 'sample');
        
        $filename = $type === 'blank' ? 'quiz_import_template_blank.csv' : 'quiz_import_template_with_samples.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        $columns = [
            'quiz_title',
            'quiz_description',
            'subject_name',
            'module_name',
            'question_text',
            'question_type',
            'option_1',
            'option_2',
            'option_3',
            'option_4',
            'correct_choice_index',
            'rationale',
            'notes'
        ];

        $callback = function() use ($columns, $type) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Add header row
            fputcsv($file, $columns);
            
            // Add sample data only if requested
            if ($type === 'sample') {
                $sampleData = [
                    [
                        'Medical Board Review Quiz',
                        'Comprehensive medical board exam preparation covering cardiovascular and endocrine systems',
                        'Cardiovascular System',
                        'Cardiac Anatomy',
                        'What is the normal heart rate range for adults at rest?',
                        'multiple_choice',
                        '40-60 bpm',
                        '60-100 bpm',
                        '100-120 bpm',
                        '120-140 bpm',
                        '1',
                        'The normal resting heart rate for adults is 60-100 beats per minute according to the American Heart Association.',
                        'Cardiovascular System - Vital Signs'
                    ],
                    [
                        'Medical Board Review Quiz',
                        'Comprehensive medical board exam preparation covering cardiovascular and endocrine systems',
                        'Endocrine System',
                        'Pancreatic Hormones',
                        'Which hormone is primarily responsible for regulating blood glucose levels?',
                        'multiple_choice',
                        'Insulin',
                        'Cortisol',
                        'Thyroxine',
                        'Growth hormone',
                        '0',
                        'Insulin is the primary hormone that regulates blood glucose by facilitating cellular glucose uptake and storage.',
                        'Endocrine System - Pancreatic Hormones'
                    ],
                    [
                        'Nursing Fundamentals Quiz',
                        'Essential nursing concepts and evidence-based procedures',
                        'Infection Control',
                        'Hand Hygiene',
                        'What is the correct sequence for hand hygiene using alcohol-based hand rub?',
                        'multiple_choice',
                        'Apply, rub palms, rub backs, interlace fingers, rub thumbs, rub fingertips',
                        'Rub palms, apply, interlace fingers, rub backs, rub thumbs, rub fingertips',
                        'Apply, rub backs, rub palms, rub thumbs, interlace fingers, rub fingertips',
                        'Interlace fingers, apply, rub palms, rub backs, rub thumbs, rub fingertips',
                        '0',
                        'The WHO 6-step technique starts with applying the hand rub, then rubbing palms together, followed by the systematic rubbing sequence.',
                        'Infection Control - Hand Hygiene'
                    ]
                ];
                
                foreach ($sampleData as $row) {
                    fputcsv($file, $row);
                }
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
