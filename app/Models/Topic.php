<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title', 'subject_id', 'content', 'video_link'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
