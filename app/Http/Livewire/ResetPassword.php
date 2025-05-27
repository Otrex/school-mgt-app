<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;


class ResetPassword extends Component
{
    public  $email;

    public $password;

    public $password_confirmation;

    public $token;

    

    protected $rules = [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed'
    ];

  

    public function mount($token)
    {
        $this->email = $_REQUEST['email'];
        $this->token = $token;
    }


    public function resetPassword()
    {
        $this->validate();
        $status = Password::broker('communities')->reset(
            [
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
                'token' => $this->token,
            ],
            function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET) {
            $this->dispatchBrowserEvent('success', __($status));
            return redirect()->route('student.login');
        } else {
            $this->dispatchBrowserEvent('error', __($status));
            return back();
        }
    }


    public function render()
    {
      
        return view('livewire.reset-password')
            ->extends('layouts.app')
            ->section('content');
    }
}
