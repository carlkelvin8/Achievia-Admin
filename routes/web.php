<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizImportController;
use App\Http\Controllers\MnController;
use App\Http\Controllers\AbbreviationController;
use App\Http\Controllers\ProcedureController;
use App\Http\Controllers\TopicController;

// Home
Route::get('/', function () {
    return view('admin.index');
});

// Courses
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

// Subjects
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{subject}/edit', [SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{subject}', [SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{subject}', [SubjectController::class, 'destroy'])->name('subjects.destroy');

// Modules
Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
Route::get('/modules/create', [ModuleController::class, 'create'])->name('modules.create');
Route::post('/modules', [ModuleController::class, 'store'])->name('modules.store');
Route::get('/modules/{module}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
Route::put('/modules/{module}', [ModuleController::class, 'update'])->name('modules.update');
Route::delete('/modules/{module}', [ModuleController::class, 'destroy'])->name('modules.destroy');


Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
Route::put('/quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
Route::delete('/quizzes/{quiz}', [QuizController::class, 'destroyQuiz'])->name('quizzes.destroy');

/* Questions under a quiz */
Route::get('/quizzes/{quiz}/questions', [QuizController::class, 'questions'])->name('quizzes.questions');
Route::post('/quizzes/{quiz}/questions', [QuizController::class, 'addQuestion'])->name('quizzes.questions.store');
Route::put('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'updateQuestion'])->name('quizzes.questions.update');
Route::delete('/quizzes/{quiz}/questions/{question}', [QuizController::class, 'destroy'])->name('quizzes.questions.destroy');
// Optional: JSON fetch for a question in a modal
Route::get('/quizzes/{quiz}/questions/{question}/edit', [QuizController::class, 'editQuestion'])->name('quizzes.questions.edit');

// Quiz Import (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/importQuiz', [QuizImportController::class, 'showForm'])->name('quiz.import.form');
    Route::post('/importQuiz', [QuizImportController::class, 'import'])->name('quiz.import');
    Route::get('/importQuiz/template', [QuizImportController::class, 'downloadTemplate'])->name('quiz.template');
});

// Mnemonics
Route::get('/mn', [MnController::class, 'index'])->name('mnemonics.index');
Route::get('/mn/create', [MnController::class, 'create'])->name('mnemonics.create');
Route::post('/mn', [MnController::class, 'store'])->name('mnemonics.store'); // avoid POST '/'

Route::get('/mn/{mnemonic}/edit', [MnController::class, 'edit'])->name('mnemonics.edit');
Route::put('/mn/{mnemonic}', [MnController::class, 'update'])->name('mnemonics.update');
Route::delete('/mn/{mnemonic}', [MnController::class, 'destroy'])->name('mnemonics.destroy');

// Abbreviations
Route::get('/abbreviation', [AbbreviationController::class, 'index'])->name('abbreviations.index');
Route::get('/abbreviation/create', [AbbreviationController::class, 'create'])->name('abbreviations.create'); // avoid plain '/create'
Route::post('/abbreviation', [AbbreviationController::class, 'store'])->name('abbreviation.store');
Route::get('/abbreviation/{abbreviation}/edit', [AbbreviationController::class, 'edit'])->name('abbreviations.edit');
Route::put('/abbreviation/{abbreviation}', [AbbreviationController::class, 'update'])->name('abbreviations.update');
Route::delete('/abbreviation/{abbreviation}', [AbbreviationController::class, 'destroy'])->name('abbreviations.destroy');

// Procedures
Route::get('/procedures', [ProcedureController::class, 'index'])->name('procedures.index');
Route::get('/procedures/create', [ProcedureController::class, 'create'])->name('procedures.create');
Route::post('/procedures', [ProcedureController::class, 'store'])->name('procedures.store');
Route::get('/procedures/{procedure}/edit', [ProcedureController::class, 'edit'])->name('procedures.edit');
Route::put('/procedures/{procedure}', [ProcedureController::class, 'update'])->name('procedures.update');
Route::delete('/procedures/{procedure}', [ProcedureController::class, 'destroy'])->name('procedures.destroy');

// Topics
Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
Route::get('/topics/{topic}/edit', [TopicController::class, 'edit'])->name('topics.edit');
Route::put('/topics/{topic}', [TopicController::class, 'update'])->name('topics.update');
Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');

// Auth & Admin
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';