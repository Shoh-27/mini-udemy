<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image', 'user_id', 'category_id' , 'status'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
