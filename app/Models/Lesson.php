<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'title', 'content', 'video_url', 'course_id'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
