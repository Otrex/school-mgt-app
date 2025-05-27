<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Portal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Component
{
    public $admin;

    public $portal;

    public $old_password;

    public $new_password;

    public $new_password_confirmation;

    protected $rules = [
        'admin.first_name' => 'required|string',
        'admin.last_name' => 'required|string',
        'portal.start_date' => '',
        'portal.end_date' => '',
        'portal.is_on' => '',
    ];

    public function updateProfile()
    {
        $this->validate();

        $this->admin->save();

        $this->dispatchBrowserEvent('success', 'Profile updated successfully!');
    }

    public function updatePortal()
    {
        $this->portal->save();

        $this->dispatchBrowserEvent('success', 'Registeration portal detail updated successfully!');
    }

    public function createPortal()
    {
        Portal::create(['is_on' => true]);

        $this->dispatchBrowserEvent('success', 'Portal created successfully!');
    }

    public function passwordReset()
    {

        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Validate old password
        if (Hash::check($this->old_password, $this->admin->password)) {
            // Validate if new password is same as old password
            if (!Hash::check($this->new_password, $this->admin->password)) {
                // update password
                $this->admin->update([
                    'password' => Hash::make($this->new_password)
                ]);

                // reset inout form
                $this->reset([
                    'new_password',
                    'old_password',
                    'new_password_confirmation'
                ]);

                $this->dispatchBrowserEvent('success', 'Password updated successfully!');
            } else {
                $this->dispatchBrowserEvent('error', 'New password can not be same as old password');
            }
        } else {
            $this->dispatchBrowserEvent('error', 'Old password does not match');
        }
    }

    public function render()
    {
        $this->admin = Auth::guard('admin')->user();

        $this->portal = Portal::all()->first();

        title('Admin - Profile');

        return view('livewire.admin.setting.my-profile')
            ->extends('layouts.admin')
            ->section('content');
    }
}
