<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_answers', function (Blueprint $table) {
            $table->id();
            $table->string('attempt_id');
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
            $table->text('answer_text')->nullable();
            $table->foreignId('choice_id')->nullable()->constrained('choices')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('quiz_id')->nullable()->constrained('quizzes')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_answers');
    }
};
