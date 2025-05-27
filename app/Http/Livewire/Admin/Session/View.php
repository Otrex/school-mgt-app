<?php

namespace App\Http\Livewire\Admin\Session;

use App\Models\Session;
use Livewire\Component;

class View extends Component
{
    public Session $session;

    protected $rules = [
        'session.session' => 'required|string',
        'session.start_date' => 'required|date',
        'session.end_date' => 'required|date',
        'session.default' => 'required'
    ];

    public function save()
    {
        $this->validate();

        $this->session->save();

        $this->dispatchBrowserEvent('success', 'Session updated!');
    }

    public function render()
    {
        title('Admin - View Session ('.$this->session->session.')');

        return view('livewire.admin.session.view')
            ->extends('layouts.admin')
            ->section('content');
    }
}
