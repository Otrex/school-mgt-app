<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Exam;

use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Str;
use App\Models\CourseSeries;
use App\Models\CourseContent;
use App\Models\OptionQuestion;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use App\Models\CourseContentsLanguages;

class EditQuestion extends Component
{

    public Exam $exam;

    public $question;


    public $course_contents_id;

    public Question $questions;

    public $value;

    public $is_correct;

    protected $rules = [
        'questions.course_series_id' => 'required',
        'questions.question' => 'required|string',
        'questions.question_duration' => 'required'
    ];

    protected $listeners = ['refresh' => 'render'];

    public function delete($optionId)
    {
        $option = OptionQuestion::find($optionId);

        if ($option == null) {
            $this->dispatchBrowserEvent('error', "Option not found!");

            return;
        }

        $option->delete();

        $this->emit('refresh');

        $this->dispatchBrowserEvent('success', "Option deleted successfully!");
    }

    public function updateQuestion()
    {
        $this->validate();

        $this->questions->save();

        $this->emit('refresh');

        $this->dispatchBrowserEvent('success', "Exam question updated successfully!");
    }


    public function addOptions()
    {
        $this->validate([
            'value' => 'required|string'
        ],);

        OptionQuestion::create([
            'question_id' => $this->questions->id,
            'value' => $this->value,
            'is_correct' => ($this->is_correct == Null) ? 0 : ($this->is_correct)
        ]);

        $this->dispatchBrowserEvent('success', "Question option added successfully!");

        $this->emit('refresh');

        $this->reset([
            'value',
            'is_correct'
        ]);
    }


    public function render()
    {
        $courses = Course::all();

        $questions = $this->exam->questions;

        $options = $this->questions->option_questions;

        $languages = CourseContentsLanguages::all();

        $lessons = CourseSeries::all();

        title('Admin - View Assessment Test');

        return view('livewire.admin.exam.edit-question', compact('courses', 'questions', 'languages','lessons','options'))
        ->extends('layouts.admin')
        ->section('content');
    }
}
