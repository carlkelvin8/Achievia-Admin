<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    /* ---------- Utilities ---------- */

    protected function cleanRte(?string $html): ?string
    {
        if ($html === null) return null;
        $html = trim($html);
        return $html; // plug purifier here if needed
    }

    protected function rteIsEmpty(?string $html): bool
    {
        $plain = trim(strip_tags((string)$html));
        return $plain === '';
    }

    /* ---------- Screens ---------- */

   // app/Http/Controllers/QuizController.php

public function index(Request $request)
{
    // optional filters; safe even if you don't use them in the view yet
    $query = \App\Models\Quiz::withCount('questions')->latest();

    if ($request->filled('subject_id')) {
        $query->where('subject_id', $request->input('subject_id'));
    }

    if ($request->filled('search')) {
        $term = $request->input('search');
        $query->where(function ($q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%")
              ->orWhereHas('questions', function ($qq) use ($term) {
                  $qq->where('question_text', 'like', "%{$term}%");
              });
        });
    }

    $rows      = $query->paginate(15);
    $subjects  = \App\Models\Subject::select('id','title')->orderBy('title')->get();

    return view('admin.quiz', [
        'rows'            => $rows,
        'quizzes'         => $rows,
        'subjects'        => $subjects,            // <-- pass this
        'totalQuestions'  => $rows->getCollection()->sum('questions_count'),
    ]);
}

    public function create()
    {
        $subjects = Subject::select('id','title')->orderBy('title')->get();
        return view('admin.quiz_create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id'  => 'required|exists:subjects,id',
            'module_id'   => 'nullable|exists:modules,id',   // <-- add
            'title'       => 'required|string',
            'description' => 'nullable|string',
        ]);
    
        $validated['description'] = $validated['description']
            ? $this->cleanRte($validated['description'])
            : null;
    
        $quiz = Quiz::create($validated);
        return redirect()->route('quizzes.questions', $quiz);
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.choices');
        return view('admin.quiz_show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        $subjects = Subject::select('id', 'title')->orderBy('title')->get();
        $modules  = Module::select('id', 'title')->orderBy('title')->get();

        return view('admin.quiz_edit', compact('quiz', 'subjects', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'subject_id'  => 'required|exists:subjects,id',
            'module_id'   => 'nullable|exists:modules,id',
            'title'       => 'required|string',
            'description' => 'nullable|string',
        ]);

        $validated['description'] = $validated['description']
            ? $this->cleanRte($validated['description'])
            : null;

        $quiz->update($validated);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully!');
    }

  
    public function questions(Quiz $quiz)
    {
        $quiz->load('questions.choices');
        return view('admin.questions', compact('quiz'));
    }

    public function editQuestion(Quiz $quiz, Question $question)
    {
        if ($question->quiz_id !== $quiz->id) abort(404);
        return response()->json($question->load('choices'));
    }

    /* ---------- Actions ---------- */
    public function addQuestion(Request $request, Quiz $quiz)
    {
        $data = $request->validate([
            'question_text'        => 'required|string',
            'question_type'        => 'required|string|in:multiple_choice,true_false,short_answer',
            'choices'              => 'required|array|min:1',
            'choices.*.text'       => 'nullable|string',
            'choices.*.image'      => 'nullable|image|max:2048',
            'correct_index'        => 'nullable|integer',
            'correct_description'  => 'nullable|string',
            'question_image'       => 'nullable|image|max:2048',
            'notes'                => 'nullable|string',
        ]);

        if ($this->rteIsEmpty($data['question_text'] ?? '')) {
            return back()->withErrors(['question_text' => 'Question text is required.'])->withInput();
        }

        // Ensure at least one non-empty choice (text or image)
        $hasAnyChoice = false;
        foreach ($data['choices'] as $c) {
            $txt = $c['text'] ?? null;
            $img = $c['image'] ?? null;
            if (!$this->rteIsEmpty($txt ?? '') || ($img instanceof \Illuminate\Http\UploadedFile)) {
                $hasAnyChoice = true;
                break;
            }
        }
        if (!$hasAnyChoice) {
            return back()->withErrors(['choices' => 'Add at least one non-empty choice (text or image).'])->withInput();
        }

        // Sanitize correct_index to be within 0..(count-1) or null
        $correctIndex = $data['correct_index'] ?? null;
        $choiceCount  = count($data['choices']);
        if (!is_null($correctIndex)) {
            $correctIndex = (int)$correctIndex;
            if ($correctIndex < 0 || $correctIndex >= $choiceCount) {
                $correctIndex = null;
            }
        }

        try {
            return DB::transaction(function () use ($request, $data, $quiz, $correctIndex) {
                $imagePath = $request->hasFile('question_image')
                    ? $request->file('question_image')->store('questions', 'public')
                    : null;

                $question = Question::create([
                    'quiz_id'             => $quiz->id,
                    'question_text'       => $this->cleanRte($data['question_text']),
                    'question_type'       => $data['question_type'],
                    'image_path'          => $imagePath,
                    'correct_description' => isset($data['correct_description']) ? $this->cleanRte($data['correct_description']) : null,
                    'notes'               => isset($data['notes']) ? $this->cleanRte($data['notes']) : null,
                ]);

                foreach ($data['choices'] as $index => $choiceData) {
                    $txtHtml = $choiceData['text'] ?? null;
                    $imgFile = $choiceData['image'] ?? null;
                    $isTxtEmpty = $this->rteIsEmpty($txtHtml ?? '');

                    if ($isTxtEmpty && !($imgFile instanceof \Illuminate\Http\UploadedFile)) {
                        continue;
                    }

                    $choiceImagePath = ($imgFile instanceof \Illuminate\Http\UploadedFile)
                        ? $imgFile->store('choices', 'public')
                        : null;

                    Choice::create([
                        'question_id' => $question->id,
                        'choice_text' => $isTxtEmpty ? '' : $this->cleanRte($txtHtml),
                        'image'       => $choiceImagePath,
                        'is_correct'  => (!is_null($correctIndex) && $index === (int)$correctIndex) ? 1 : 0,
                    ]);
                }

                return redirect()->route('quizzes.questions', $quiz)->with('success', 'Question added!');
            });
        } catch (\Throwable $e) {
            \Log::error('AddQuestion failed', ['quiz_id' => $quiz->id, 'msg' => $e->getMessage()]);
            return back()->withInput()->with('error', 'Save failed: '.$e->getMessage());
        }
    }

    public function updateQuestion(Request $request, Quiz $quiz, Question $question)
    {
        if ($question->quiz_id !== $quiz->id) abort(404);

        $data = $request->validate([
            'question_text'        => 'required|string',
            'question_type'        => 'required|string|in:multiple_choice,true_false,short_answer',
            'choices'              => 'required|array|min:1',
            'choices.*.id'         => 'nullable|integer|exists:choices,id',
            'choices.*.text'       => 'nullable|string',
            'choices.*.image'      => 'nullable|image|max:2048',
            'correct_index'        => 'nullable|integer',
            'correct_description'  => 'nullable|string',
            'question_image'       => 'nullable|image|max:2048',
            'notes'                => 'nullable|string',
        ]);

        if ($this->rteIsEmpty($data['question_text'] ?? '')) {
            return back()->withErrors(['question_text' => 'Question text is required.'])->withInput();
        }

        // Normalize correct index
        $correctIndex = $data['correct_index'] ?? null;
        if (!is_null($correctIndex)) $correctIndex = (int)$correctIndex;

        try {
            return DB::transaction(function () use ($request, $data, $question, $quiz, $correctIndex) {

                if ($request->hasFile('question_image')) {
                    if ($question->image_path && Storage::disk('public')->exists($question->image_path)) {
                        Storage::disk('public')->delete($question->image_path);
                    }
                    $question->image_path = $request->file('question_image')->store('questions', 'public');
                }

                $question->update([
                    'question_text'       => $this->cleanRte($data['question_text']),
                    'question_type'       => $data['question_type'],
                    'correct_description' => isset($data['correct_description']) ? $this->cleanRte($data['correct_description']) : null,
                    'image_path'          => $question->image_path,
                    'notes'               => isset($data['notes']) ? $this->cleanRte($data['notes']) : null,
                ]);

                $submittedIds = [];
                $touchedRows  = 0;

                foreach ($data['choices'] as $index => $choiceData) {
                    $choice = !empty($choiceData['id'])
                        ? Choice::where('question_id', $question->id)->find($choiceData['id'])
                        : null;

                    $txtHtml    = $choiceData['text'] ?? null;
                    $imgFile    = $choiceData['image'] ?? null;
                    $isTxtEmpty = $this->rteIsEmpty($txtHtml ?? '');

                    // brand-new & empty -> skip
                    if (!$choice && $isTxtEmpty && !($imgFile instanceof \Illuminate\Http\UploadedFile)) {
                        continue;
                    }

                    if (!$choice) {
                        $choice = new Choice(['question_id' => $question->id]);
                    }

                    if ($imgFile instanceof \Illuminate\Http\UploadedFile) {
                        if ($choice->image && Storage::disk('public')->exists($choice->image)) {
                            Storage::disk('public')->delete($choice->image);
                        }
                        $choice->image = $imgFile->store('choices', 'public');
                    }

                    $choice->choice_text = $isTxtEmpty ? '' : $this->cleanRte($txtHtml);
                    $choice->is_correct  = (!is_null($correctIndex) && $index === (int)$correctIndex) ? 1 : 0;

                    // if existed and became totally empty -> delete
                    if ($choice->choice_text === '' && empty($choice->image) && !empty($choiceData['id'])) {
                        $choice->delete();
                        continue;
                    }

                    $choice->save();
                    $submittedIds[] = $choice->id;
                    $touchedRows++;
                }

                // remove not-resubmitted choices
                $question->choices()->whereNotIn('id', $submittedIds)->delete();

                if ($touchedRows === 0) {
                    return back()->withErrors(['choices' => 'Provide at least one non-empty choice (text or image).'])->withInput();
                }

                return redirect()->route('quizzes.questions', $quiz)->with('success', 'Question updated successfully!');
            });
        } catch (\Throwable $e) {
            \Log::error('UpdateQuestion failed', [
                'quiz_id' => $quiz->id,
                'question_id' => $question->id,
                'msg' => $e->getMessage()
            ]);
            return back()->withInput()->with('error', 'Update failed: '.$e->getMessage());
        }
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        if ($question->quiz_id !== $quiz->id) abort(404);

        if ($question->image_path && Storage::disk('public')->exists($question->image_path)) {
            Storage::disk('public')->delete($question->image_path);
        }

        $question->choices()->each(function ($c) {
            if ($c->image && Storage::disk('public')->exists($c->image)) {
                Storage::disk('public')->delete($c->image);
            }
        });

        $question->choices()->delete();
        $question->delete();

        return back()->with('success', 'Question deleted successfully!');
    }

    public function destroyQuiz(Quiz $quiz)
    {
        foreach ($quiz->questions as $q) {
            foreach ($q->choices as $c) {
                if ($c->image && Storage::disk('public')->exists($c->image)) {
                    Storage::disk('public')->delete($c->image);
                }
            }
            $q->choices()->delete();
        }
        $quiz->questions()->delete();
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Exam deleted successfully!');
    }
}