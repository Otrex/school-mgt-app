<?php

namespace App\Http\Livewire\Admin\Session;

use App\Models\Session;
use Livewire\Component;

class Add extends Component
{
    public $session;

    public $start_date;

    public $end_date;

    public $default;

    protected $rules = [
        'session' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'default' => 'required'
    ];

    public function add()
    {
        $this->validate();

        Session::create([
            'session' => $this->session,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'default' => $this->default
        ]);

        $this->dispatchBrowserEvent('success', 'New session added successfully!');

        // reset form
        $this->reset([
            'session',
            'start_date',
            'end_date',
            'default'
        ]);
    }

    public function render()
    {
        title('Admin - Add New Session');

        return view('livewire.admin.session.add')
            ->extends('layouts.admin')
            ->section('content');
    }
}
