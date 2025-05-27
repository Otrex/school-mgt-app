<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLogout extends Component
{
    public function logout()
    {
        $admin = Auth::guard('admin');

        $admin->logout();

        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.auth.admin-logout');
    }
}
