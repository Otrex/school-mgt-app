<?php

namespace App\Http\Livewire\Community;

use Livewire\Component;
use App\Models\ExamResult;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

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
        title('Community Member Result View');

        $answers = Auth::guard('community')->user()->answers()->where('exam_id', $this->exam_result->exam->id)->paginate(1);

        $option_tag = ['A', 'B', 'C', 'D'];

        return view('livewire.community.result-view', compact('answers', 'option_tag'))
            ->extends('layouts.community')
            ->section('content');
    }
}
