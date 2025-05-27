<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'course_series_id',
        'question',
        'question_duration'
    ];

    protected $with = ['exam', 'courseSeries', 'option_questions'];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function courseSeries()
    {
        return $this->belongsTo(CourseSeries::class);
    }

    public function option_questions()
    {
        return $this->hasMany(OptionQuestion::class);
    }
}
