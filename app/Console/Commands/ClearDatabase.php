<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearDatabase extends Command
{
    protected $signature = 'db:clear';
    protected $description = 'Clear all data from the database';

    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        $tables = [
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
                $this->info("Truncated: $table");
            }
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->info('Database cleared successfully!');
    }
}
