<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        $tables = [
            'quiz_answers',
            'choices',
            'questions',
            'quizzes',
            'procedures',
            'mnemonics',
            'abbreviations',
            'topics',
            'modules',
            'subjects',
            'courses',
            'section',
            'users',
        ];
        
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
