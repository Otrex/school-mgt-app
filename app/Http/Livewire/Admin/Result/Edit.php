<?php

namespace App\Http\Livewire\Admin\Result;

use App\Models\Course;
use App\Models\Result;
use App\Models\Session;
use App\Traits\Utilities;
use Livewire\Component;

class Edit extends Component
{
    use Utilities;

    public Course $course;

    public $results;

    public $session;

    protected $rules = [
        'results.*.score' => 'sometimes|required|numeric'
    ];

    public function clear()
    {
        $this->reset(['session']);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->results as $result) {
            $result->grade = $this->grade($result->score);
            $result->save();
        }

        $this->dispatchBrowserEvent('success', 'Result updated successfully!');
    }

    public function render()
    {
        $sessions = Session::latest()->get();

        $current_session = Session::where('default', true)->first();

        $results_count = Result::where('course_id', $this->course->id)->count();

        $this->results = Result::where('course_id', $this->course->id)
            ->where('session', $this->session ?? $current_session->session)
            ->get();

        title('Admin - Edit Result');

        return view('livewire.admin.result.edit', compact('sessions', 'current_session', 'results_count'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
