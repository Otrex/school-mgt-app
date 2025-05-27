<?php

namespace App\Http\Livewire\Admin\TertiaryInstitution;

use App\Models\TertiaryInstitution;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;

class Add extends Component
{
    use LocalGovernmentTown;

    public $tertiary_institution_name;

    public $state;

    public $local_government;

    public $town;

    protected $rules = [
        'tertiary_institution_name' => 'required|string',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
    ];

    public function add()
    {
        $this->validate();

        TertiaryInstitution::create([
            'name' => $this->tertiary_institution_name,
            'state' => $this->getStateName($this->state),
            'state_id' => $this->state,
            'local_government' => $this->getLocalGovernmentName($this->local_government),
            'local_government_id' => $this->local_government,
            'town' => $this->getTownName($this->town),
            'town_id' => $this->town,
        ]);

        $this->dispatchBrowserEvent('success', 'New School added successfully!');

        $this->reset(['tertiary_institution_name', 'state', 'local_government', 'town']);
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];

        title('Admin - Add New Tertiary Institution');

        return view('livewire.admin.tertiary-institution.add', compact('states', 'local_governments', 'towns'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
