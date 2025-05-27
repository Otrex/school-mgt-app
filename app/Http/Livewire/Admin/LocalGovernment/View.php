<?php

namespace App\Http\Livewire\Admin\LocalGovernment;

use App\Models\LocalGovernment;
use App\Models\State;
use Livewire\Component;

class View extends Component
{
    public LocalGovernment $local_government;

    protected $rules = [
        'local_government.name' => 'required|string',
        'local_government.state_id' => 'required'
    ];

    protected $messages = [
        'local_government.name.required' => 'The local government name is required',
        'local_government.name.string' => 'The local government name  must be a string',
        'local_government.state_id.required' => 'The state name is required',
    ];

    public function save()
    {
        $this->validate();

        $this->local_government->save();

        $this->dispatchBrowserEvent('success', 'Local government detail updated');
    }

    public function render()
    {
        $states = State::all();

        title('Admin - View Local Government Area ('.$this->local_government->name.')');

        return view('livewire.admin.local-government.view', compact('states'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
