<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $login_id;

    public $password;

    public $next;

    protected $rules = [
        'login_id' => 'required|string',
        'password' => 'required|string'
    ];

    protected $messages = [
        'login_id.required' => 'Reg. No or Email address is required'
    ];

    public function mount()
    {
        $this->next = request()->query('next');
    }

    public function login()
    {
        $this->validate();

        $login_id = filter_var($this->login_id, FILTER_VALIDATE_EMAIL);

        $route = null;

        if ($login_id) {

            $login_attempt = Auth::guard('community')->attempt([
                'email' => $this->login_id,
                'password' => $this->password,
            ]);

            $route = 'community.member.dashboard';
        } else {
            $login_attempt = Auth::attempt([
                'reg_no' => $this->login_id,
                'password' => $this->password,
            ]);

            $route = 'student.dashboard';
        }

        if (!$login_attempt) {

            $this->dispatchBrowserEvent('error', 'Invalid login details');
        } else {
            if(!is_null($this->next)) {
                return redirect()->to($this->next);
            } else {
                return redirect()->route($route);
            }
        }
    }

    public function render()
    {
        title('Membership Login');

        return view('livewire.auth.user-login')
            ->extends('layouts.app')
            ->section('content');
    }
}
