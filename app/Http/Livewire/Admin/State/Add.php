<?php

namespace App\Http\Livewire\Admin\State;

use App\Models\State;
use Livewire\Component;

class Add extends Component
{
    public $name;

    protected $rules = ['name' => 'required|string|unique:states'];

    protected $messages = [
        'name.required' => 'The state name field is required',
        'name.string' => 'The state name field must be a string',
        'name.unique' => 'This state has already been added',
    ];

    public function add()
    {
        $this->validate();

        State::create(['name' => $this->name]);

        $this->dispatchBrowserEvent('success', 'State added successfully');

        $this->reset(['name']);
    }

    public function render()
    {
        title('Admin - Add New State');

        return view('livewire.admin.state.add')
            ->extends('layouts.admin')
            ->section('content');
    }
}
