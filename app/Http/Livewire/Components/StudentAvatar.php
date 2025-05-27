<?php

namespace App\Http\Livewire\Components;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class StudentAvatar extends Component
{
    public $user;
    
    public $type = '';

    protected $listeners = ['refresh_avatar' => 'render'];

    public function removeAvatar() 
    {
        if(!is_null($this->user->image))
            Storage::disk('public')->delete("avatar/{$this->user->image}");

        $this->user->update(['image' => '']);

        $this->emit('refresh_avatar');

        $this->dispatchBrowserEvent('success', 'Profile image removed successfully!');
    }

    public function render()
    {
        $this->user = Auth::user();
        return view('livewire.components.student-avatar');
    }
}
