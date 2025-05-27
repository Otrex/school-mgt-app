<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'course_contents_language_id',
        'number_of_question',
        'instruction',
        'time_duration',
        'is_available'
    ];

    protected $with = ['course', 'language'];

    protected $casts = ['is_available' => 'boolean'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function language()
    {
        return $this->belongsTo(CourseContentsLanguages::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function attempts()
    {
        return $this->hasMany(Attempt::class);
    }

    public function examResults()
    {
        return $this->hasMany(ExamResult::class);
    }
    
}
