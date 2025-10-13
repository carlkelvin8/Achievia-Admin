<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\Module;
use App\Models\Subject;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $subjectId = $request->get('subject_id');
        $search = $request->get('search'); // search input
    
        $quizzes = Quiz::with('subject')
            ->withCount('questions')
            ->when($subjectId, function ($query) use ($subjectId) {
                $query->where('subject_id', $subjectId);
            })
            ->when($search, function ($query) use ($search) {
                // search inside related questions
                $query->whereHas('questions', function ($q) use ($search) {
                    $q->where('question_text', 'LIKE', "%{$search}%");
                });
            })
            ->latest()
            ->get();
    
        $subjects = Subject::all();
    
        // ✅ total number of questions across filtered quizzes
        $totalQuestions = $quizzes->sum('questions_count');
    
        return view('admin.quiz', compact('quizzes', 'subjects', 'subjectId', 'search', 'totalQuestions'));
    }
    
    
public function create()
{
    $subjects = Subject::all(); // <-- load subjects instead of modules
    return view('admin.quiz_create', compact('subjects'));
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $quiz = Quiz::create($validated);

        return redirect()->route('quizzes.questions', $quiz->id);
    }


    public function questions($quizId)
    {
        $quiz = Quiz::with('questions.choices')->findOrFail($quizId);
        return view('admin.questions', compact('quiz'));
    }

    public function addQuestion(Request $request, $quizId)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:multiple_choice,true_false,short_answer',
            'choices' => 'required|array|min:1',
            'choices.*.text' => 'nullable|string',
            'choices.*.image' => 'nullable|image|max:2048',
            'correct' => 'nullable|array',
            'correct.*' => 'integer',
            'correct_description' => 'nullable|string',
            'question_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string'
        ]);

        $imagePath = $request->hasFile('question_image') 
            ? $request->file('question_image')->store('questions', 'public') 
            : null;

        $question = Question::create([
            'quiz_id' => $quizId,
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'image_path' => $imagePath,
            'correct_description' => $request->correct_description,
            'notes' => $request->notes,
        ]);

        foreach ($request->choices as $index => $choiceData) {
            if (empty($choiceData['text']) && empty($choiceData['image'])) continue;

            $choiceImagePath = isset($choiceData['image']) && $choiceData['image'] instanceof \Illuminate\Http\UploadedFile
                ? $choiceData['image']->store('choices', 'public')
                : null;

            Choice::create([
                'question_id' => $question->id,
                'choice_text' => $choiceData['text'] ?? null,
                'image' => $choiceImagePath,
                'is_correct' => in_array($index, $request->correct ?? []) ? 1 : 0,
            ]);
        }

        return back()->with('success', 'Question added!');
    }

    public function updateQuestion(Request $request, $quizId, $questionId)
    {
        $request->validate([
            'question_text' => 'required|string',
            'question_type' => 'required|string|in:multiple_choice,true_false,short_answer',
            'choices' => 'required|array|min:1',
            'choices.*.id' => 'nullable|integer|exists:choices,id',
            'choices.*.text' => 'nullable|string',
            'choices.*.image' => 'nullable|image|max:2048',
            'correct' => 'nullable|array',
            'correct.*' => 'integer',
            'correct_description' => 'nullable|string',
            'question_image' => 'nullable|image|max:2048',
            'notes' => 'nullable|string',
        ]);

        $question = Question::where('quiz_id', $quizId)->findOrFail($questionId);

        // Update question image if uploaded
        if ($request->hasFile('question_image')) {
            if ($question->image_path && \Storage::disk('public')->exists($question->image_path)) {
                \Storage::disk('public')->delete($question->image_path);
            }
            $question->image_path = $request->file('question_image')->store('questions', 'public');
        }

        $question->update([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
            'correct_description' => $request->correct_description,
            'image_path' => $question->image_path,
            'notes' => $request->notes,
        ]);

        // Update or create choices
        foreach ($request->choices as $index => $choiceData) {
            $choice = isset($choiceData['id']) 
                ? Choice::find($choiceData['id']) 
                : new Choice(['question_id' => $question->id]);

            // Handle choice image upload
            if (isset($choiceData['image']) && $choiceData['image'] instanceof \Illuminate\Http\UploadedFile) {
                if ($choice->image && \Storage::disk('public')->exists($choice->image)) {
                    \Storage::disk('public')->delete($choice->image);
                }
                $choice->image = $choiceData['image']->store('choices', 'public');
            }

            $choice->choice_text = $choiceData['text'] ?? null;
            $choice->is_correct = in_array($index, $request->correct ?? []) ? 1 : 0; // ✅ fixed
            $choice->question_id = $question->id;
            $choice->save();
        }

        return back()->with('success', 'Question updated successfully!');
    }

    public function destroy($quizId, $questionId)
    {
        $question = Question::where('quiz_id', $quizId)->findOrFail($questionId);

        if ($question->image_path && \Storage::disk('public')->exists($question->image_path)) {
            \Storage::disk('public')->delete($question->image_path);
        }

        $question->choices()->delete();
        $question->delete();

        return back()->with('success', 'Question deleted successfully!');
    }

    public function destroyQuiz(Quiz $quiz)
    {
        $quiz->questions()->each(function($question){
            $question->choices()->delete();
        });

        $quiz->questions()->delete();
        $quiz->delete();

        return redirect()->route('quizzes.index')->with('success', 'Exam deleted successfully!');
    }

    public function edit(Quiz $quiz)
    {
        $modules = Module::all();
        return view('admin.quiz_edit', compact('quiz', 'modules'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'module_id' => 'required|exists:modules,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $quiz->update($validated);

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully!');
    }
}
