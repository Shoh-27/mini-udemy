<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reason', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
