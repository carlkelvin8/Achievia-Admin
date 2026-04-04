<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        // Cardiovascular Quiz
        $quiz1 = Quiz::create([
            'title' => 'Cardiovascular System Basics',
            'description' => 'Test your knowledge of the cardiovascular system',
            'subject_id' => 1,
            'module_id' => 1,
        ]);

        $this->createQuestion($quiz1->id, 'What is the normal heart rate range for adults at rest?', [
            '40-60 bpm',
            '60-100 bpm',
            '100-120 bpm',
            '120-140 bpm',
        ], 1);

        $this->createQuestion($quiz1->id, 'Which chamber of the heart pumps oxygenated blood to the body?', [
            'Right atrium',
            'Right ventricle',
            'Left atrium',
            'Left ventricle',
        ], 3);

        // Endocrine Quiz
        $quiz2 = Quiz::create([
            'title' => 'Endocrine System Quiz',
            'description' => 'Test your knowledge of hormones and glands',
            'subject_id' => 2,
            'module_id' => 3,
        ]);

        $this->createQuestion($quiz2->id, 'Which hormone is primarily responsible for regulating blood glucose levels?', [
            'Insulin',
            'Cortisol',
            'Thyroxine',
            'Growth hormone',
        ], 0);

        $this->createQuestion($quiz2->id, 'Where is the thyroid gland located?', [
            'In the brain',
            'In the neck',
            'In the abdomen',
            'In the chest',
        ], 1);

        // Nursing Quiz
        $quiz3 = Quiz::create([
            'title' => 'Nursing Fundamentals Quiz',
            'description' => 'Essential nursing concepts and procedures',
            'subject_id' => 4,
            'module_id' => 6,
        ]);

        $this->createQuestion($quiz3->id, 'What is the correct sequence for hand hygiene using alcohol-based hand rub?', [
            'Apply, rub palms, rub backs, interlace fingers, rub thumbs, rub fingertips',
            'Rub palms, apply, interlace fingers, rub backs, rub thumbs, rub fingertips',
            'Apply, rub backs, rub palms, rub thumbs, interlace fingers, rub fingertips',
            'Interlace fingers, apply, rub palms, rub backs, rub thumbs, rub fingertips',
        ], 0);

        // Engineering Quiz
        $quiz4 = Quiz::create([
            'title' => 'Electrical Engineering Fundamentals',
            'description' => 'Core electrical engineering concepts',
            'subject_id' => 7,
            'module_id' => 12,
        ]);

        $this->createQuestion($quiz4->id, 'What is Ohm\'s Law?', [
            'V = I × R',
            'P = V × I',
            'F = ma',
            'E = mc²',
        ], 0);

        $this->createQuestion($quiz4->id, 'In a series circuit, what happens to the current?', [
            'It increases',
            'It remains the same throughout',
            'It decreases',
            'It alternates',
        ], 1);

        // Pharmacology Quiz
        $quiz5 = Quiz::create([
            'title' => 'Pharmacology Basics',
            'description' => 'Drug classifications and mechanisms',
            'subject_id' => 9,
            'module_id' => 15,
        ]);

        $this->createQuestion($quiz5->id, 'Which class of drugs is used as first-line treatment for hypertension?', [
            'ACE inhibitors',
            'Beta blockers',
            'Calcium channel blockers',
            'Diuretics',
        ], 0);
    }

    private function createQuestion($quizId, $questionText, $choices, $correctIndex)
    {
        $question = Question::create([
            'quiz_id' => $quizId,
            'question_text' => $questionText,
            'question_type' => 'multiple_choice',
        ]);

        foreach ($choices as $index => $choiceText) {
            Choice::create([
                'question_id' => $question->id,
                'choice_text' => $choiceText,
                'is_correct' => $index === $correctIndex,
            ]);
        }
    }
}
