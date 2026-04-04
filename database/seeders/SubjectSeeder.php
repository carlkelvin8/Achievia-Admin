<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            // Medical Board Review subjects
            ['title' => 'Cardiovascular System', 'description' => 'Heart, blood vessels, and circulation', 'course_id' => 1, 'image' => null],
            ['title' => 'Endocrine System', 'description' => 'Hormones and glandular functions', 'course_id' => 1, 'image' => null],
            ['title' => 'Respiratory System', 'description' => 'Lungs and breathing mechanisms', 'course_id' => 1, 'image' => null],
            
            // Nursing Fundamentals subjects
            ['title' => 'Patient Care Basics', 'description' => 'Fundamental nursing care procedures', 'course_id' => 2, 'image' => null],
            ['title' => 'Infection Control', 'description' => 'Infection prevention and control measures', 'course_id' => 2, 'image' => null],
            ['title' => 'Vital Signs', 'description' => 'Monitoring and recording vital signs', 'course_id' => 2, 'image' => null],
            
            // Engineering Basics subjects
            ['title' => 'Electrical Engineering', 'description' => 'Circuits, voltage, and current', 'course_id' => 3, 'image' => null],
            ['title' => 'Mechanical Engineering', 'description' => 'Forces, motion, and mechanics', 'course_id' => 3, 'image' => null],
            
            // Pharmacology subjects
            ['title' => 'Antihypertensive Drugs', 'description' => 'Blood pressure management medications', 'course_id' => 4, 'image' => null],
            ['title' => 'Antibiotics', 'description' => 'Antimicrobial agents and resistance', 'course_id' => 4, 'image' => null],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
