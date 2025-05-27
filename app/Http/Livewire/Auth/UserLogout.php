<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogout extends Component
{
    public $type = '';

    public function logout()
    {
        Auth::logout();

        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.auth.user-logout');
    }
}
