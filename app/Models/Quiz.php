<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    protected $table = 'quizzes';
    public $timestamps = false; // Disable timestamps for now

    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'module_id', // now present in DB
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}