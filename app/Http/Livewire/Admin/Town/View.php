<?php

namespace App\Http\Livewire\Admin\Town;

use App\Models\Town;
use App\Traits\LocalGovernmentTown;
use Livewire\Component;

class View extends Component
{
    use LocalGovernmentTown;

    public Town $town;

    protected $rules = [
        'town.state' => 'required',
        'town.local_government_id' => 'required',
        'town.name' => 'required'
    ];

    protected $messages = [
        'town.local_government_id.required' => "The local government field is required",
    ];

    public function save()
    {
        $this->validate();

        $this->town->save();

        $this->dispatchBrowserEvent('success', 'Town updated successfully!');
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->town->state)) ? $this->localGovernments($this->town->state) : [];

        title('Admin - View Town ('.$this->town->name.')');

        return view('livewire.admin.town.view', compact('states', 'local_governments'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
