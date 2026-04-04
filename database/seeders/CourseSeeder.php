<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            [
                'title' => 'Medical Board Review',
                'description' => 'Comprehensive medical board exam preparation course covering all major medical specialties.',
                'image' => null,
            ],
            [
                'title' => 'Nursing Fundamentals',
                'description' => 'Essential nursing concepts and evidence-based clinical procedures.',
                'image' => null,
            ],
            [
                'title' => 'Engineering Basics',
                'description' => 'Core engineering principles and mathematical foundations.',
                'image' => null,
            ],
            [
                'title' => 'Pharmacology Essentials',
                'description' => 'Drug classifications, mechanisms of action, and clinical applications.',
                'image' => null,
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
