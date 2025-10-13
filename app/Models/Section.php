<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    public $timestamps = false;
    protected $fillable = [
        'title',
         'user_id',
         'status',
         'teacher_id'

    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
public function students()
{
    return $this->hasMany(User::class, 'section_id')->where('role', 'student');
}

public function teacher()
{
    return $this->hasOne(User::class, 'section_id')->where('role', 'teacher');
}

}
