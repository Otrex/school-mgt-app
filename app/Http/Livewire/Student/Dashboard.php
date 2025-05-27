<?php

namespace App\Http\Livewire\Student;

use NumberFormatter;
use App\Models\Result;
use Livewire\Component;
use App\Models\CourseSeries;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function getProgramLessonCount(int $course_id)
    {
        return CourseSeries::where(['course_id' => $course_id])->count();
    }

    public function getCompletedProgramLessonCount(int $course_id)
    {
        return Auth::user()->finishes()->where('course_id', $course_id)->count();
    }

    public function isLessonCompleted(int $course_id)
    {
        return $this->getCompletedProgramLessonCount($course_id) == $this->getProgramLessonCount($course_id);
    }

    public function render()
    {
        $results = Auth::user()->examResults;

        $total_score = Auth::user()->examResults->sum('score');

        $cummulative_percentage = ($results->count() == 0) ? 0 : ($total_score/(count($results) * 100)) * 100;

        $student_score = Result::all()->groupBy('user_id');

        $attempted_programs = Auth::user()->finishes->unique('course_id');

        title('Student Dashboard');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.student.dashboard', compact('cummulative_percentage', 'attempted_programs'))
            ->extends('layouts.user')
            ->section('content');
    }
}
