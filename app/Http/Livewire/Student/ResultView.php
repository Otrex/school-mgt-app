<?php

namespace App\Http\Livewire\Student;

use App\Models\ExamResult;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ResultView extends Component
{
    use WithPagination;

    public ExamResult $exam_result;

    public function getQueryString()
    {
        return [];
    }

    public function render()
    {
        title('Student Result View');

        $answers = Auth::user()->answers()->where('exam_id', $this->exam_result->exam->id)->paginate(1);

        $option_tag = ['A', 'B', 'C', 'D'];

        return view('livewire.student.result-view', compact('answers', 'option_tag'))
            ->extends('layouts.user')
            ->section('content');
    }
}
