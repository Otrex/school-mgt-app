<?php

namespace App\Http\Livewire\Admin\Result;

use App\Models\Course;
use App\Models\Result;
use App\Models\Session;
use Livewire\Component;

class View extends Component
{
    public Course $course;

    public $session;

    public function clear()
    {
        $this->reset(['session']);
    }

    public function render()
    {
        $sessions = Session::latest()->get();

        $current_session = Session::where('default', true)->first();

        $results_count = Result::where('course_id', $this->course->id)->count();

        $results = Result::where('course_id', $this->course->id)
            ->where('session', $this->session ?? $current_session->session)
            ->paginate();

        title('Admin - View Result');

        return view('livewire.admin.result.view', compact('results', 'sessions', 'current_session', 'results_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
