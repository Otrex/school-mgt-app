<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use App\Models\Community;
use App\Models\Course;
use App\Models\Finish;
use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $student_count = User::count() + Community::count();

        $courses = Course::orderBy('created_at', 'desc')->take(3)->get();

        $course_count = Course::count();

        $blogs = Blog::where('is_publish', true)->latest()->limit(3)->get();

        $completed_lessons = Finish::count();

        title('Home');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.home', compact('student_count', 'courses', 'blogs', 'completed_lessons', 'course_count'))
            ->extends('layouts.app')
            ->section('content');
    }
}
