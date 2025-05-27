<?php

namespace App\Http\Livewire\Student;

use App\Models\School;
use Livewire\Component;
use App\Traits\MediaUpload;
use Livewire\WithFileUploads;
use App\Traits\LocalGovernmentTown;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Profile extends Component
{
    use LocalGovernmentTown,
        WithFileUploads,
        MediaUpload;

    public $user;

    public $old_password;

    public $new_password;

    public $new_password_confirmation;

    public $avatar;

    protected $listeners = ['render'];

    protected array $rules = [
        'user.first_name' => 'required|string',
        'user.last_name' => 'required|string',
        'user.phone' => 'required|string|max:11',
        'user.email' => 'required|email',
        'user.gender' => 'required|string',
        'user.school' => 'required|string',
        'user.state' => 'required|string',
        'user.local_government' => 'required|string',
        'user.town' => 'required|string',
        'user.home_address' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $this->user->save();

        $this->dispatchBrowserEvent("success", "Profile updated!");
    }

    public function passwordReset()
    {
        $this->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Validate old password
        if (Hash::check($this->old_password, $this->user->password)) {
            // Validate if new password is same as old password
            if (!Hash::check($this->new_password, $this->user->password)) {
                // update password
                $this->user->update([
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

    public function changeProfileImage()
    {
        $this->validate(['avatar' => 'required|string']);

        $avatar = $this->storeAvatar($this->avatar, $this->user->first_name, 'avatar');

        if(!is_null($this->user->image) && !is_url($this->user->image))
            Storage::disk('public')->delete("avatar/{$this->user->image}");

        $this->user->update(['image' => $avatar]);

        $this->emit('refresh_avatar');

        $this->dispatchBrowserEvent('success', 'Profile image updated successfully!');

        $this->reset(['avatar']);
    }

    public function render()
    {
        $this->user = Auth::user();

        $states = $this->states();
        $local_governments = (isset($this->user->state)) ? $this->localGovernments($this->user->state) : [];
        $towns = (isset($this->user->local_government)) ? $this->towns($this->user->local_government) : [];

        $schools = isset($this->user->town) ? School::where('town', $this->user->town)->get() : [];

        title('Student Profile');
        // seo()->description('Blip School is a product of Telage Concepts to bring technology education and collaborations to the most underserved communities in Nigeria');

        return view('livewire.student.profile', compact('states', 'local_governments', 'towns', 'schools'))
            ->extends('layouts.user')
            ->section('content');
    }
}
