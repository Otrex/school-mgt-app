<?php

namespace App\Http\Livewire\Admin\LocalGovernment;

use App\Models\LocalGovernment;
use App\Models\State;
use Livewire\Component;

class Add extends Component
{
    public $state;

    public $name;

    protected $rules = [
        'state' => 'required',
        'name' => 'required|string|unique:local_governments'
    ];

    protected $messages = [
        'name.required' => 'Local government name is required',
        'name.string' => 'Local government name must be a string',
        'name.unique' => 'This local government has already been added',
    ];

    public function add()
    {
        $this->validate();

        LocalGovernment::create([
            'state_id' => $this->state,
            'name' => $this->name
        ]);

        $this->dispatchBrowserEvent('success', 'New local government added successfully');

        $this->reset(['state', 'name']);
    }

    public function render()
    {
        $states = State::all();

        title('Admin - Add Local Government Area');

        return view('livewire.admin.local-government.add', compact('states'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
