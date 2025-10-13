<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizImportController extends Controller
{
    public function showForm()
    {
        return view('admin.import_quiz');
    }

    public function import(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,txt',
        ]);

        $path = $request->file('csv')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_map('trim', $data[0]);
        unset($data[0]);

        DB::beginTransaction();
        try {
            foreach ($data as $row) {
                $row = array_combine($header, $row);

                $quiz = Quiz::firstOrCreate([
                    'title' => $row['quiz_title'],
                    'module_id' => $row['module_id'],
                ], [
                    'description' => $row['quiz_description'] ?? null,
                ]);

                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => $row['question_text'],
                    'question_type' => $row['question_type'],
                ]);

                for ($i = 1; $i <= 4; $i++) {
                    Choice::create([
                        'question_id' => $question->id,
                        'choice_text' => $row["choice_$i"],
                        'is_correct' => ((int)$row['correct_choice_index'] === $i - 1),
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Quiz imported successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
