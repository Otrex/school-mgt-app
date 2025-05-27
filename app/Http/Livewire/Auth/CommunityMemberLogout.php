<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CommunityMemberLogout extends Component
{
    public $type = null;

    public function logout()
    {
        Auth::guard('community')->logout();

        return redirect()->route('index');
    }

    public function render()
    {
        return view('livewire.auth.community-member-logout');
    }
}
