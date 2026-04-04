<?php

namespace Database\Seeders;

use App\Models\Abbreviation;
use Illuminate\Database\Seeder;

class AbbreviationSeeder extends Seeder
{
    public function run(): void
    {
        $abbreviations = [
            // Cardiovascular
            ['short_form' => 'HR', 'full_form' => 'Heart Rate', 'subject_id' => 1],
            ['short_form' => 'BP', 'full_form' => 'Blood Pressure', 'subject_id' => 1],
            ['short_form' => 'MI', 'full_form' => 'Myocardial Infarction', 'subject_id' => 1],
            ['short_form' => 'CHF', 'full_form' => 'Congestive Heart Failure', 'subject_id' => 1],
            
            // Endocrine
            ['short_form' => 'DM', 'full_form' => 'Diabetes Mellitus', 'subject_id' => 2],
            ['short_form' => 'TSH', 'full_form' => 'Thyroid Stimulating Hormone', 'subject_id' => 2],
            ['short_form' => 'T3', 'full_form' => 'Triiodothyronine', 'subject_id' => 2],
            ['short_form' => 'T4', 'full_form' => 'Thyroxine', 'subject_id' => 2],
            
            // Respiratory
            ['short_form' => 'RR', 'full_form' => 'Respiratory Rate', 'subject_id' => 3],
            ['short_form' => 'O2', 'full_form' => 'Oxygen', 'subject_id' => 3],
            ['short_form' => 'CO2', 'full_form' => 'Carbon Dioxide', 'subject_id' => 3],
            
            // Nursing
            ['short_form' => 'ADL', 'full_form' => 'Activities of Daily Living', 'subject_id' => 4],
            ['short_form' => 'NPO', 'full_form' => 'Nothing by Mouth', 'subject_id' => 4],
            
            // Infection Control
            ['short_form' => 'PPE', 'full_form' => 'Personal Protective Equipment', 'subject_id' => 5],
            ['short_form' => 'HAI', 'full_form' => 'Healthcare-Associated Infection', 'subject_id' => 5],
            
            // Vital Signs
            ['short_form' => 'Temp', 'full_form' => 'Temperature', 'subject_id' => 6],
            ['short_form' => 'SpO2', 'full_form' => 'Oxygen Saturation', 'subject_id' => 6],
        ];

        foreach ($abbreviations as $abbr) {
            Abbreviation::create($abbr);
        }
    }
}
