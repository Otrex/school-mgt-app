<?php

namespace App\Http\Livewire\Auth;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmailVerificationNotice extends Component
{
    public function resendVerificationLink()
    {
        $auth = Auth::guard('community')->user();

        Community::find($auth->id)->sendEmailVerificationNotification();

        $this->dispatchBrowserEvent('success', 'Verification link sent!');
    }

    public function render()
    {
        title('Email Verification Notice');

        return view('livewire.auth.email-verification-notice')
            ->extends('layouts.auth.main')
            ->section('content');
    }
}
