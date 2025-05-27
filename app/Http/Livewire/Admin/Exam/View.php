<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Exam;
use App\Models\Course;
use App\Models\CourseContentsLanguages;
use App\Models\CourseSeries;
use Livewire\Component;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class View extends Component
{
    public Exam $exam;

    public $question;

    public $correct_answer;

    public $edit_question;

    public $edit_option_a;

    public $edit_option_b;

    public $edit_option_c;

    public $edit_option_d;

    public $edit_correct_answer;

    public $selectedItem;

    public $action;

    public $modelId;

    public $course_series_id;

    public $question_duration = 60;

    protected $rules = [
        'exam.course_id' => 'required',
        'exam.course_contents_language_id' => 'required',
        'exam.number_of_question' => 'required|numeric|min:1|max:100',
        'exam.time_duration' => 'required|numeric|min:1|max:120',
        'exam.instruction' => 'nullable|string',
        'exam.is_available' => 'required|boolean',
        'course_series_id' => 'required'
    ];

    protected $messages = [
        'exam.course_id.required' => 'The course field is required',
        'exam.course_contents_language_id.required' => 'The language field is required',
        'exam.time_duration.min' => 'Exam time duration must be minimum of :min minute',
        'exam.time_duration.max' => 'Exam time duration must be maximum of :max minute',
    ];

    protected $listeners = [
        'refresh' => 'render',
        'getModelId'
    ];

    public function save()
    {
        try {
            $this->validate([
                'exam.course_id' => 'required',
                'exam.course_contents_language_id' => 'required',
                'exam.number_of_question' => 'required|numeric|min:1|max:100',
                'exam.time_duration' => 'required|numeric|min:1|max:120',
                'exam.instruction' => 'nullable|string',
                'exam.is_available' => 'required|boolean',
            ]);
        } catch (\Throwable $th) {
            return $this->dispatchBrowserEvent('error', $th->getMessage());
        }

        $this->exam->save();

        $this->dispatchBrowserEvent('success', 'Exam details updated successfully!');
    }

    public function delete($id)
    {
        if (isset($id)) {

            $exam = Question::find($id);

            $exam->delete();

            $this->dispatchBrowserEvent('success', 'Question deleted successully!');
        }
    }

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $exam_question = Question::find($this->modelId);
        $this->edit_question = $exam_question->question;
        $this->edit_option_a = $exam_question->option_a;
        $this->edit_option_b = $exam_question->option_b;
        $this->edit_option_c = $exam_question->option_c;
        $this->edit_option_d = $exam_question->option_d;
        $this->edit_correct_answer = $exam_question->correct_answer;
    }

    public function selectItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'edit') {
            $this->dispatchBrowserEvent('openModal');

            $exam_question = Question::find($this->selectedItem);
            $this->edit_question = $exam_question->question;
            $this->edit_option_a = $exam_question->option_a;
            $this->edit_option_b = $exam_question->option_b;
            $this->edit_option_c = $exam_question->option_c;
            $this->edit_option_d = $exam_question->option_d;
            $this->edit_correct_answer = $exam_question->correct_answer;
        }
    }

    public function update()
    {
        $this->validate(
            [
                'edit_question' => 'required|string',
                'edit_option_a' => 'required|string',
                'edit_option_b' => 'required|string',
                'edit_option_c' => 'required|string',
                'edit_option_d' => 'required|string',
                'edit_correct_answer' => 'required|string|'.
                Rule::in([$this->edit_option_a, $this->edit_option_b, $this->edit_option_c, $this->edit_option_d]),
            ], ['edit_correct_answer.in' => 'The selected correct answer is not found in the options']
        );

        Question::find($this->selectedItem)->update([
            'question' => $this->edit_question,
            'option_a' => $this->edit_option_a,
            'option_b' => $this->edit_option_b,
            'option_c' => $this->edit_option_c,
            'option_d' => $this->edit_option_d,
            'correct_answer' => $this->edit_correct_answer
        ]);

        $this->emitSelf('refresh');

        $this->dispatchBrowserEvent('success', 'Exam question updated successfully!');

        $this->dispatchBrowserEvent('closeModal');

        $this->reset([
            'edit_question',
            'edit_option_a',
            'edit_option_b',
            'edit_option_c',
            'edit_option_d',
            'edit_correct_answer'
        ]);
    }

    public function addQuestion()
    {
        $this->validate([
            'question' => 'required|string',
            'course_series_id' => 'required',
            'question_duration' => 'required',
        ], ['course_series_id.required' => 'Lesson is required']);

        Question::create([
            'exam_id' => $this->exam->id,
            'course_series_id' => $this->course_series_id,
            'question' => $this->question,
            'question_duration' => $this->question_duration,
        ]);

        $this->emitSelf('refresh');

        $this->dispatchBrowserEvent('success', 'New question created successfully!');

        $this->reset([
            'course_series_id',
            'question'
        ]);
    }

    public function render()
    {
        $courses = Course::all();

        $questions = $this->exam->questions;

        $languages = CourseContentsLanguages::all();

        $lessons = CourseSeries::all();

        title('Admin - View Assessment Test');

        return view('livewire.admin.exam.view', compact('courses', 'questions', 'languages','lessons'))
            ->extends('layouts.admin')
            ->section('content');
    }
}