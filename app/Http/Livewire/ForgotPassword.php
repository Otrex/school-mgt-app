<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    protected $rules = ['email' => 'required|email'];

    public function sendLink()
    {
        $this->validate();

        $status = Password::broker('communities')->sendResetLink(
            ['email' => $this->email]
        );
      
        if($status === Password::RESET_LINK_SENT) {
            $this->dispatchBrowserEvent('success', __($status));
        } else {
            $this->reset(['email']);
            $this->dispatchBrowserEvent('error', __($status));
        }

        return back();
    }

    public function render()
    {
        return view('livewire.forgot-password')
        ->extends('layouts.app')
        ->section('content');
    }
}
