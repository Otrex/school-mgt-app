<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContent extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['CourseContentsLanguages'];

    public function courseSeries()
    {
        return $this->belongsTo(CourseSeries::class);
    }

    public function courseContentsLanguages()
    {
        return $this->belongsTo(CourseContentsLanguages::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
