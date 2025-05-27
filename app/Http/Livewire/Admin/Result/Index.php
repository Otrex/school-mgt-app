<?php

namespace App\Http\Livewire\Admin\Result;

use App\Models\Course;
use App\Models\Result;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $courses = Course::all();

        $results_count = Result::count();

        title('Admin - All Results');

        return view('livewire.admin.result.index', compact('courses', 'results_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
