<?php

namespace App\Http\Livewire\Community;

use App\Models\CourseSeries;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function getProgramLessonCount(int $course_id)
    {
        return CourseSeries::where(['course_id' => $course_id])->count();
    }

    public function getCompletedProgramLessonCount(int $course_id)
    {
        return Auth::guard('community')->user()
            ->finishes()->where('course_id', $course_id)
            ->count();
    }

    public function isLessonCompleted(int $course_id)
    {
        return $this->getCompletedProgramLessonCount($course_id) == $this->getProgramLessonCount($course_id);
    }

    public function render()
    {
        $results = Auth::guard('community')->user()->examResults;
        $total_score = Auth::guard('community')->user()->examResults->sum('score');

        $cummulative_percentage = ($results->count() == 0) ? 0 : ($total_score/(count($results) * 100)) * 100;

        if($cummulative_percentage <= 30){
            $badge = "Fail ❌";
        }elseif($cummulative_percentage >= 31 && $cummulative_percentage <= 44){
            $badge = "Fair 😔";
        }elseif($cummulative_percentage >= 45 && $cummulative_percentage <= 55){
            $badge = "Average 🙂";
        }elseif($cummulative_percentage >= 56 && $cummulative_percentage <= 69){
            $badge = "Good 😇";
        }elseif($cummulative_percentage >= 70 && $cummulative_percentage <= 79){
            $badge = "Very Good ✔";
        }elseif($cummulative_percentage >= 80){
            $badge = "Excellent ✔✔";
        }

        if (count($results) < 1) {
            $badge = "---";
        }

        $attempted_programs = Auth::guard('community')->user()->finishes->unique('course_id');
        $location = Auth::guard('community')->user()->town;
        $referrer_code = Auth::guard('community')->user()->referrer_code;
        $referrer_route = route('communities.register');
        title('Community Member Dashboard');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community.dashboard', compact('cummulative_percentage','badge', 'attempted_programs', 'location', 'referrer_code', 'referrer_route'))
            ->extends('layouts.community')
            ->section('content');
    }
}