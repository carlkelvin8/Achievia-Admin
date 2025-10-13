<?php

// app/Models/Quiz.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['subject_id', 'title', 'description'];

    public $timestamps = false;
    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    // Quiz.php
public function subject()
{
    return $this->belongsTo(Subject::class);
}


    public function questions()
    {
        return $this->hasMany(Question::class);
    }

}
