<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'community_id',
        'course_id',
        'session',
        'score',
        'grade',
    ];

    protected $with = ['user', 'course'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
