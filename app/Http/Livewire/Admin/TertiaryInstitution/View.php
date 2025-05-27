<?php

namespace App\Http\Livewire\Admin\TertiaryInstitution;

use Livewire\Component;
use App\Models\TertiaryInstitution;
use App\Traits\LocalGovernmentTown;

class View extends Component
{
    use LocalGovernmentTown;

    public TertiaryInstitution $tertiary_institution;

    protected $rules = [
        'tertiary_institution.state_id' => 'required',
        'tertiary_institution.local_government_id' => 'required',
        'tertiary_institution.town_id' => 'required',
        'tertiary_institution.name' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $this->tertiary_institution->state = $this->getStateName($this->tertiary_institution->state_id);
        $this->tertiary_institution->local_government = $this->getLocalGovernmentName($this->tertiary_institution->local_government_id);
        $this->tertiary_institution->town = $this->getTownName($this->tertiary_institution->town_id);

        $this->tertiary_institution->save();

        $this->dispatchBrowserEvent('success', 'Tertiary institution detail updated successfully!');
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->tertiary_institution->state_id)) ? $this->localGovernments($this->tertiary_institution->state_id) : [];
        $towns = (isset($this->tertiary_institution->local_government_id)) ? $this->towns($this->tertiary_institution->local_government_id) : [];

        title('Admin - View Tertiary Institution ('.$this->tertiary_institution->name.')');

        return view('livewire.admin.tertiary-institution.view', compact('states', 'local_governments', 'towns'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
