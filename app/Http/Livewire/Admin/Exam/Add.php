<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Course;
use App\Models\CourseContentsLanguages;
use App\Models\Exam;
use Livewire\Component;

class Add extends Component
{
    public $course_id;

    public $language_id;

    public $number_of_question;

    public $time_duration;

    public $instruction;

    protected $rules = [
        'course_id' => 'required|unique:exams',
        'language_id' => 'required',
        'number_of_question' => 'required|numeric|min:1|max:150',
        'time_duration' => 'required|numeric|min:1|max:120',
        'instruction' => 'nullable|string'
    ];

    protected $messages = [
        'course_id.required' => 'The course field is required',
        'language_id.required' => 'The exam language field is required',
        'course_id.unique' => 'The exam for this course has already been created',
        'time_duration.min' => 'Exam time duration must be minimum of :min minutes',
        'time_duration.max' => 'Exam time duration must be maximum of :max minutes',
    ];

    public function add()
    {
        $this->validate();

        $exam = Exam::create([
            'course_id' => $this->course_id,
            'course_contents_language_id' => $this->language_id,
            'number_of_question' => $this->number_of_question,
            'time_duration' => $this->time_duration,
            'instruction' => $this->instruction
        ]);

        $this->dispatchBrowserEvent('success', 'New exam added successfully!');

        $this->reset([
            'course_id',
            'language_id',
            'number_of_question',
            'time_duration',
            'instruction'
        ]);

        return redirect()->route('admin.exam.view', $exam)->with('active_tab', 2);
    }

    public function render()
    {
        $courses = Course::all();

        $languages = CourseContentsLanguages::all();

        title('Admin - Add Assessment Test');

        return view('livewire.admin.exam.add', compact('courses', 'languages'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
