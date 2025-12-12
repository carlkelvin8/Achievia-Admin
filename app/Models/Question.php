<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'image_path',
        'correct_description',
        'notes',
    ];
    public $timestamps = false;

    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'quiz_id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'question_id')->orderBy('id');
    }
}