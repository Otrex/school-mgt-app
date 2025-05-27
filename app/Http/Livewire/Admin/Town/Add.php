<?php

namespace App\Http\Livewire\Admin\Town;

use App\Models\Town;
use App\Traits\LocalGovernmentTown;
use Livewire\Component;

class Add extends Component
{
    use LocalGovernmentTown;

    public $state;

    public $local_government;

    public $name;

    protected $rules = [
        'state' => 'required',
        'local_government' => 'required',
        'name' => 'required|string',
    ];

    // protected $messages = [
    //     'name.required' => 'The town name is required',
    //     'name.unique' => 'This town has already been added',
    // ];

    public function add()
    {
        $this->validate();

        Town::create([
            'state' => $this->state,
            'local_government_id' => $this->local_government,
            'name' => $this->name
        ]);

        $this->dispatchBrowserEvent('success', 'New town added');

        $this->reset(['state', 'local_government', 'name']);
    }

    public function render()
    {
        $states = $this->states();

        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];

        title('Admin - Add New Town');

        return view('livewire.admin.town.add', compact('states', 'local_governments'))
            ->extends('layouts.admin')
            ->section('content');
    }
}