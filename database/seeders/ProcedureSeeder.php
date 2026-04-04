<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    public function run(): void
    {
        $procedures = [
            ['title' => 'Blood Pressure Measurement', 'subject_id' => 1, 'file_path' => null],
            ['title' => 'Cardiac Auscultation', 'subject_id' => 1, 'file_path' => null],
            ['title' => 'Blood Glucose Testing', 'subject_id' => 2, 'file_path' => null],
            ['title' => 'Lung Auscultation', 'subject_id' => 3, 'file_path' => null],
            ['title' => 'Patient Bathing', 'subject_id' => 4, 'file_path' => null],
            ['title' => 'Wound Dressing Change', 'subject_id' => 4, 'file_path' => null],
            ['title' => 'Hand Hygiene Protocol', 'subject_id' => 5, 'file_path' => null],
            ['title' => 'PPE Donning and Doffing', 'subject_id' => 5, 'file_path' => null],
            ['title' => 'Temperature Measurement', 'subject_id' => 6, 'file_path' => null],
            ['title' => 'Pulse Assessment', 'subject_id' => 6, 'file_path' => null],
        ];

        foreach ($procedures as $procedure) {
            Procedure::create($procedure);
        }
    }
}
