<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choices';
    protected $fillable = ['question_id', 'choice_text', 'image', 'is_correct'];
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}