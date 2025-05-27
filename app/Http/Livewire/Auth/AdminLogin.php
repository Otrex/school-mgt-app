<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminLogin extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required',
        'password' => 'required'
    ];

    public function login()
    {
        $this->validate();

        $login_attempt = Auth::guard('admin')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if (!$login_attempt) {

            $this->dispatchBrowserEvent('error', 'Invalid login details');
        } else {

            if (Auth::guard('admin')->user()->status == "suspended") {

                Auth::guard('admin')->logout();

                $this->dispatchBrowserEvent('error', 'Your account has been suspended');

                return back();
            }

            // Redirect for super Admin
            if (Auth::guard('admin')->user()->roles->contains('name', 'super_admin')) {

                return redirect()->route('admin.dashboard');
            }

            // Redirect for admin
            if (Auth::guard('admin')->user()->roles->contains('name', 'admin')) {

                return redirect()->route('admin.dashboard');
            }

            // Redirect for content creator
            if (Auth::guard('admin')->user()->roles->contains('name', 'content_creator')) {

                return redirect()->route('admin.blogs');
            }
        }
    }

    public function render()
    {
        title('Admin Login');

        return view('livewire.auth.admin-login')
            ->extends('layouts.auth.main')
            ->section('content');
    }
}
