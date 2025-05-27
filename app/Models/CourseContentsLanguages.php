<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseContentsLanguages extends Model
{
    use HasFactory;
    protected $guard = 'course_contents_languages';

    protected $fillable = ['language','disable'];

    public function courseContent()
    {
        return $this->hasMany(CourseContent::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
