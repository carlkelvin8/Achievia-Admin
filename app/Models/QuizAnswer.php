<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{

    protected $fillable = [
        'attempt_id',
        'question_id',
        'answer_text',
        'choice_id',
    ];

    public $timestamps = false;

    public function user()
{
    return $this->belongsTo(User::class);
}

public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

public function question()
{
    return $this->belongsTo(Question::class);
}

public function choice()
{
    return $this->belongsTo(Choice::class);
}

}
