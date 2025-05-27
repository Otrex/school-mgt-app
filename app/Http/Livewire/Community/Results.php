<?php

namespace App\Http\Livewire\Community;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Results extends Component
{
    public $member;

    public function render()
    {
        $this->member = Auth::guard('community')->user();

        $results = $this->member->examResults;

        title('Community Member Results');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.community.results', compact('results'))
            ->extends('layouts.community')
            ->section('content');
    }
}
