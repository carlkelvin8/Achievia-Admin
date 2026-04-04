<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();
        
        $modules = [
            // Cardiovascular System modules
            ['title' => 'Cardiac Anatomy', 'description' => 'Structure and anatomy of the heart', 'subject_id' => 1, 'user_id' => $teacher->id],
            ['title' => 'Arrhythmias', 'description' => 'Abnormal heart rhythms and management', 'subject_id' => 1, 'user_id' => $teacher->id],
            
            // Endocrine System modules
            ['title' => 'Pancreatic Hormones', 'description' => 'Insulin and glucagon functions', 'subject_id' => 2, 'user_id' => $teacher->id],
            ['title' => 'Thyroid Function', 'description' => 'Thyroid hormones and metabolism', 'subject_id' => 2, 'user_id' => $teacher->id],
            
            // Respiratory System modules
            ['title' => 'Lung Mechanics', 'description' => 'Breathing and gas exchange', 'subject_id' => 3, 'user_id' => $teacher->id],
            
            // Patient Care modules
            ['title' => 'Hygiene and Comfort', 'description' => 'Patient hygiene and comfort measures', 'subject_id' => 4, 'user_id' => $teacher->id],
            ['title' => 'Wound Care', 'description' => 'Wound assessment and management', 'subject_id' => 4, 'user_id' => $teacher->id],
            
            // Infection Control modules
            ['title' => 'Hand Hygiene', 'description' => 'Proper hand washing techniques', 'subject_id' => 5, 'user_id' => $teacher->id],
            ['title' => 'PPE Usage', 'description' => 'Personal protective equipment guidelines', 'subject_id' => 5, 'user_id' => $teacher->id],
            
            // Vital Signs modules
            ['title' => 'Blood Pressure', 'description' => 'Measuring and interpreting blood pressure', 'subject_id' => 6, 'user_id' => $teacher->id],
            ['title' => 'Temperature and Pulse', 'description' => 'Temperature and pulse measurement', 'subject_id' => 6, 'user_id' => $teacher->id],
            
            // Electrical Engineering modules
            ['title' => 'Ohm\'s Law', 'description' => 'Voltage, current, and resistance relationships', 'subject_id' => 7, 'user_id' => $teacher->id],
            ['title' => 'Circuit Analysis', 'description' => 'Series and parallel circuits', 'subject_id' => 7, 'user_id' => $teacher->id],
            
            // Mechanical Engineering modules
            ['title' => 'Newton\'s Laws', 'description' => 'Laws of motion and forces', 'subject_id' => 8, 'user_id' => $teacher->id],
            
            // Pharmacology modules
            ['title' => 'ACE Inhibitors', 'description' => 'Angiotensin-converting enzyme inhibitors', 'subject_id' => 9, 'user_id' => $teacher->id],
            ['title' => 'Beta Blockers', 'description' => 'Beta-adrenergic blocking agents', 'subject_id' => 9, 'user_id' => $teacher->id],
            ['title' => 'Penicillins', 'description' => 'Penicillin-based antibiotics', 'subject_id' => 10, 'user_id' => $teacher->id],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}
