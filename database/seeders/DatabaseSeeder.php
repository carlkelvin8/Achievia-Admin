<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            SubjectSeeder::class,
            ModuleSeeder::class,
            QuizSeeder::class,
            TopicSeeder::class,
            AbbreviationSeeder::class,
            MnemonicSeeder::class,
            ProcedureSeeder::class,
        ]);
    }
}
