<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class QuestionaireSubmitted extends Component
{
    public function render()
    {
        $route_name = null;

        $student_is_logged_in = Auth::check();

        $community_member_is_logged_in = Auth::guard('community')->check();

        if($student_is_logged_in)
            $route_name = 'student.dashboard';

        if($community_member_is_logged_in)
            $route_name = 'community.member.dashboard';

        title('Program Accessment Test Submitted');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.questionaire-submitted', compact('route_name'))
            ->extends('layouts.question')
            ->section('content');
    }
}
