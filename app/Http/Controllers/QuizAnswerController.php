<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\Auth;

class QuizAnswerController extends Controller
{
    /**
     * Show the quiz answering page.
     */
    public function show(Quiz $quiz)
    {
        // Eager load questions and their choices
        $quiz->load(['questions.choices']);

        return view('quizzes.take', compact('quiz'));
    }

    /**
     * Store user's quiz answers.
     */
    public function submit(Request $request, Quiz $quiz)
    {
        $user = Auth::user();

        // Validate input
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'required|exists:choices,id',
        ]);

        $answers = $validated['answers'];

        $insertRows = [];
        foreach ($answers as $questionId => $choiceId) {
            $insertRows[] = [
                'user_id'     => $user->id,
                'quiz_id'     => $quiz->id,
                'question_id' => $questionId,
                'choice_id'   => $choiceId,
            ];
        }
        QuizAnswer::insert($insertRows);

        // Calculate score using a single query
        $choiceIds = array_values($answers);
        $correct   = Choice::whereIn('id', $choiceIds)->where('is_correct', 1)->count();

        return redirect()->route('quizzes.index')->with('success', "Quiz submitted! You scored $correct out of " . count($answers));
    }
}
