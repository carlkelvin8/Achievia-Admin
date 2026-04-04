<?php

namespace Database\Seeders;

use App\Models\Mnemonic;
use Illuminate\Database\Seeder;

class MnemonicSeeder extends Seeder
{
    public function run(): void
    {
        $mnemonics = [
            // Cardiovascular
            ['title' => 'HEART Score', 'description' => 'History, EKG, Age, Risk factors, Troponin', 'subject_id' => 1, 'file_path' => null],
            
            // Endocrine
            ['title' => 'Diabetes Complications', 'description' => 'HHNS - Hyperglycemic Hyperosmolar Nonketotic State', 'subject_id' => 2, 'file_path' => null],
            
            // Respiratory
            ['title' => 'Lung Zones', 'description' => 'ABCDE - Apex, Base, Cardiac notch, Diaphragm, Esophagus', 'subject_id' => 3, 'file_path' => null],
            
            // Nursing
            ['title' => 'Maslow\'s Hierarchy', 'description' => 'Physiological, Safety, Love/Belonging, Esteem, Self-actualization', 'subject_id' => 4, 'file_path' => null],
            
            // Infection Control
            ['title' => 'Hand Hygiene Steps', 'description' => 'Apply, Rub palms, Rub backs, Interlace, Rub thumbs, Rub fingertips', 'subject_id' => 5, 'file_path' => null],
            
            // Pharmacology
            ['title' => 'Antihypertensive Classes', 'description' => 'ACE, ARB, Beta-blockers, Calcium channel blockers, Diuretics', 'subject_id' => 9, 'file_path' => null],
        ];

        foreach ($mnemonics as $mnemonic) {
            Mnemonic::create($mnemonic);
        }
    }
}
