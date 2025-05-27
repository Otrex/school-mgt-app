<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QuestionaireNotice extends Component
{
    public $exam_id;

    public function proceed()
    {
       session()->forget('exam_questions');
        session()->put('exam_id', $this->exam_id);
        return redirect()->route('exam.question');
    }

    public function render()
    {
        $this->exam_id = session()->get('id');

        title('Program Accessment Test Instruction');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.questionaire-notice')
            ->extends('layouts.question')
            ->section('content');
    }
}
