<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = ['title', 'file_path',  'subject_id',];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}


