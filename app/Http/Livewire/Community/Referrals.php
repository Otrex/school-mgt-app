<?php

namespace App\Http\Livewire\Community;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Referrals extends Component
{
    public function render()
    {
        $member = Auth::guard('community')->user();

        $referrals = $member->referrals;

        title('Community Member Referrals');

        return view('livewire.community.referrals', compact('referrals'))
            ->extends('layouts.community')
            ->section('content');
    }
}
