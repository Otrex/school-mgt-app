<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use App\Models\ResourceType;

class AddResourceType extends Component
{
    public $name;

    protected $rules = [

        'name' => 'required|string|unique:resource_types',

    ];

    public function addResourceType()
    {
        $this->validate();

        ResourceType::create([

            'name' => $this->name,

        ]);

        $this->dispatchBrowserEvent('success', 'New Resource Type added');

        $this->reset(['name']);

    }

    public function render()
    {
        return view('livewire.admin.setting.add-resource-type')

            ->extends('layouts.admin')

            ->section('content');
    }
}
