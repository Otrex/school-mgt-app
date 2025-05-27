<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use App\Traits\LocalGovernmentTown;
use Livewire\Component;

class View extends Component
{
    use LocalGovernmentTown;

    public School $school;

    protected $rules = [
        'school.state_id' => 'required',
        'school.local_government_id' => 'required',
        'school.town_id' => 'required',
        'school.name' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $this->school->state = $this->getStateName($this->school->state_id);
        $this->school->local_government = $this->getLocalGovernmentName($this->school->local_government_id);
        $this->school->town = $this->getTownName($this->school->town_id);

        $this->school->save();

        $this->dispatchBrowserEvent('success', 'School detail updated successfully!');
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->school->state_id)) ? $this->localGovernments($this->school->state_id) : [];
        $towns = (isset($this->school->local_government_id)) ? $this->towns($this->school->local_government_id) : [];

        title('Admin - View School ('.$this->school->name.')');

        return view('livewire.admin.school.view', compact('states', 'local_governments', 'towns'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
