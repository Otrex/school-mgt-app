<?php

namespace App\Http\Livewire\Admin\State;

use App\Models\State;
use Livewire\Component;

class View extends Component
{
    public State $state;

    protected $rules = [
        'state.name' => 'required|string'
    ];

    public function save()
    {
        $this->validate();

        $this->state->save();

        $this->dispatchBrowserEvent('success', 'State updated successfully');
    }

    public function render()
    {
        title('Admin - View State ('.$this->state->name.')');

        return view('livewire.admin.state.view')
            ->extends('layouts.admin')
            ->section('content');
    }
}
