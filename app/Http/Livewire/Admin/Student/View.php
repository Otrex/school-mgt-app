<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\User;
use App\Models\School;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;

class View extends Component
{
    use LocalGovernmentTown;

    public User $user;

    protected array $rules = [
        'user.first_name' => 'required|string',
        'user.last_name' => 'required|string',
        'user.phone' => 'nullable|string|max:11',
        'user.email' => 'nullable|email',
        'user.gender' => 'required|string',
        'user.school_id' => 'required',
        'user.state_id' => 'required',
        'user.local_government_id' => 'required',
        'user.town_id' => 'required',
        'user.home_address' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $this->user->school = $this->getSchoolName($this->user->school_id);
        $this->user->state = $this->getStateName($this->user->state_id);
        $this->user->local_government = $this->getLocalGovernmentName($this->user->local_government_id);
        $this->user->town = $this->getTownName($this->user->town_id);

        $this->user->save();

        $this->dispatchBrowserEvent("success", "Student profile updated!");
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->user->state_id)) ? $this->localGovernments($this->user->state_id) : [];
        $towns = (isset($this->user->local_government_id)) ? $this->towns($this->user->local_government_id) : [];

        $schools = isset($this->user->town) ? School::where('town', $this->getTownName($this->user->town_id))->get() : [];

        title('Admin - View Student ('.$this->user->fullname.')');

        return view('livewire.admin.student.view', compact('states', 'local_governments', 'towns', 'schools'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
