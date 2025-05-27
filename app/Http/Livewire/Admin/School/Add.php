<?php

namespace App\Http\Livewire\Admin\School;

use App\Models\School;
use App\Traits\LocalGovernmentTown;
use Livewire\Component;

class Add extends Component
{
    use LocalGovernmentTown;

    public $school_name;

    public $state = 4;

    public $local_government;

    public $town;

    protected $rules = [
        'school_name' => 'required|string',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
    ];

    public function add()
    {
        $this->validate();

        School::create([
            'name' => $this->school_name,
            'state' => $this->getStateName($this->state),
            'state_id' => $this->state,
            'local_government' => $this->getLocalGovernmentName($this->local_government),
            'local_government_id' => $this->local_government,
            'town' => $this->getTownName($this->town),
            'town_id' => $this->town,
        ]);

        $this->dispatchBrowserEvent('success', 'New School added successfully!');

        $this->reset(['school_name', 'state', 'local_government', 'town']);
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        title('Admin - Add New School');

        return view('livewire.admin.school.add',  compact('states', 'local_governments', 'towns'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
