<?php

namespace App\Http\Livewire\Student;

use App\Models\Session;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Results extends Component
{
    public $student;

    public function render()
    {
        $this->student = Auth::user();

        $sessions = Session::latest()->get();

        $current_session = Session::where('default', true)->first();

        $results = $this->student->examResults;

        title('Student Result');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.student.results', compact('results', 'sessions'))
            ->extends('layouts.user')
            ->section('content');
    }
}
