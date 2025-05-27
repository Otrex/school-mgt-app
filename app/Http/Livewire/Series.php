<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseContent;
use App\Models\Enrolment;
use App\Models\Exam;

class Series extends Component
{
    public Course $course;

    public $series;
    public $auth_user;
    public $selected_language;

    public function mount($serial_no)
    {
        $this->series = $this->course->courseSeries()
            ->where('serial_no', $serial_no)->first() ?? abort(403, 'Request not allowed');
        $this->selected_language = session('selected_language') ?? redirect()->route('courses');
    }

    public function markCompleted($series_id, $serial_no)
    {
        if (!is_null($this->auth_user)) {

            $this->auth_user->finishes()->create([
                'course_id' => $this->course->id,
                'course_series_id' => $series_id,
                'serial_no' => $serial_no,
                'status' => 'completed'
            ]);

            $this->dispatchBrowserEvent('success', "Lesson {$serial_no} completed");
        }
    }

    public function takeTest()
    {
        session()->put('take_test', true);
        // $exam_id = $this->course->exams->first()->id;

        $exam_id = Exam::where([
            'course_id' => $this->course->id,
            'course_contents_language_id' => session()->get('selected_language')->id
        ])->first()->id;
        session()->put('id',  $exam_id);
        return redirect()->route('exam.notice')->with('id', $exam_id);
    }

    public function render()
    {
        $course_content = CourseContent::where([
            'course_series_id'=>$this->series->id,'course_contents_languages_id' => session('selected_language')->id
        ])->take(1)->get();

        $payments_made = null;

        $completed = null;

        // auth for club member
        if (Auth::check()) {

            $payments_made = Auth::user()->payments()->where('course_id', $this->course->id)->get();
            $completed = Auth::user();
        }

        // auth for community member
        if(Auth::guard('community')->check()) {

            $payments_made = Auth::guard('community')->user()->payments()->where('course_id', $this->course->id)->get();
            $completed = Auth::guard('community')->user();
        }

        // get the model relationship that shows
        // a user finished a course and assign it
        // to the 'auth_user' property
        $this->auth_user = $completed;

        $enrolled_user = Enrolment::where('member_id', $this->auth_user->id)->first();

        if (!$enrolled_user && $this->course->bill_type === "Free") {
            Enrolment::create([
                'member_id' => $this->auth_user->id,
                'course_id' => $this->course->id
            ]);
        }

        // get the total series available in this program/course
        $total_series = $this->course->courseSeries->count();

        // Check if a course series is completed and return the status
        $is_completed = function($series_id) use ($completed) {
            $status = is_null($completed) ? false : $completed->finishes()->where([
                'course_id' => $this->course->id,
                'course_series_id' => $series_id
            ])->get()->count() > 0;

            return $status;
        };

        // check if an exam has been made available for student to take
        $is_exam_available = ($this->course->exams->count() > 0) ?
            $this->course->exams->first()->is_available :
            false;

        // check if an exam has been taken by a user
        if (!is_null($this->auth_user)) {
            $is_exam_taken = ($this->course->exams->count() == 0) ? false :
            $this->auth_user->attempts()->where('exam_id', $this->course->exams->first()->id)->count() > 0;
        } else {
            $is_exam_taken = false;
        }

        title('Program Series');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.series', compact('payments_made', 'is_completed', 'total_series', 'is_exam_available', 'is_exam_taken','course_content'))
            ->extends('layouts.app')
            ->section('content');
    }
}