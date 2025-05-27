<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSeries extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_no',
        'title',
        'summary',
        'media_url',
        'slug',
    ];

    protected $with = ['course'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function courseContent()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
