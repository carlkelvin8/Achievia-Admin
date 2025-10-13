<?php

// app/Models/Subject.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['title', 'description', 'course_id', 'image'];
    public $timestamps = false;
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }

}
