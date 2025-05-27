<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;

class Courses extends Component
{
    public function enroll()
    {
        // create an enrollment table and populate here
    }

    public function render()
    {
        $courses = Course::get();

        title('Programs');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.courses', compact('courses'))
            ->extends('layouts.app')
            ->section('content');
    }
}