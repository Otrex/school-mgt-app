<?php

namespace App\Http\Livewire;

use App\Models\Course;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseContentsLanguages;
use App\Models\CourseContent;



class CourseDetail extends Component
{
    public Course $course;

    public $language = '';

    protected $queryString = ['language'];


    public function render()
    {

        if(empty($this->language)){
            $selected_language = CourseContentsLanguages::where('language', 'English')->first();
            session()->put('selected_language', $selected_language);
        }
        else{
            $selected_language = CourseContentsLanguages::where('id', $this->language)->first();
            session()->put('selected_language', $selected_language);
            session()->flash('success', "Language has been successfully changed to ".$selected_language->language );
        }


        // Fetch the course series according to the current course
        $course_series = $this->course->courseSeries()->orderBy('serial_no')->get();

        // for storing auth user that have made payment for this course
        $payments_made = null;

        $auth_user = null;

        // auh check for club member
        if (Auth::check()) {

            $payments_made = Auth::user()->payments()->where('course_id', $this->course->id)->get();
            $auth_user = Auth::user();
        }

        // auth check for community member
        if(Auth::guard('community')->check()) {

            $payments_made = Auth::guard('community')->user()->payments()->where('course_id', $this->course->id)->get();
            $auth_user = Auth::guard('community')->user();
        }

        // Load completed
        if (!is_null($auth_user)) {

            $last = $auth_user->finishes()->where('course_id', $this->course->id)->get()->last();
            $next = is_null($last) ? 1 : $last->serial_no + 1;
        } else {
            $next = 1;
        }

        title(ucwords($this->course->name));
        seo()->image($this->course->image, false);
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        $ids = array();
        foreach($course_series as $series) {
            $ids[] = $series->id;
        }

        $language_ids = CourseContent::select('course_contents_languages_id')->whereIn('course_series_id', $ids)->get();

        $ids = array();
        foreach($language_ids as $lang_id) {
            $ids[] = $lang_id->course_contents_languages_id;
        }

        $languages = CourseContentsLanguages::select('id', 'language')->whereIn('id', $ids)->get();

        return view('livewire.course-detail', compact('course_series', 'payments_made', 'next', 'languages'))
            ->extends('layouts.app')
            ->section('content');
    }
}
