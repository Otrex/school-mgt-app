<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_scholarship_course',
        'course_category_id',
        'name',
        'summary',
        'fee',
        'bill_type',
        'duration',
        'image',
        'slug',
    ];

    protected $with = ['courseCategory'];

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function courseSeries()
    {
        return $this->hasMany(CourseSeries::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function finishes()
    {
        return $this->hasMany(Finish::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'course_id');
    }
}