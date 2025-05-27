<?php

namespace App\Http\Livewire\Admin\CommunityCenter;

use Livewire\Component;
use App\Models\CommunityCenter;
use App\Traits\LocalGovernmentTown;

class Add extends Component
{
    use LocalGovernmentTown;

    public $local_government;
    public $opening_hours;
    public $closing_hours;
    public $address;
    public $name;
    public $state;
    public $member;
    public $town;

    protected array $rules = [
        'opening_hours' => 'required|date_format:H:i',
        'closing_hours' => 'required|date_format:H:i',
        'name' => 'required|string',
        'state' => 'required',
        'local_government' => 'required',
        'town' => 'required',
        'address' => 'required|string',
    ];

    public function add()
    {
        $this->validate();

        CommunityCenter::create([
            'local_government_id' => $this->local_government,
            'opening_hours' => $this->opening_hours,
            'closing_hours' => $this->closing_hours,
            'manager_id' => $this->member ?? null,
            'name' => $this->name,
            'address' => $this->address,
            'state_id' => $this->state,
            'town_id' => $this->town,
            'is_active' =>  true,
        ]);

        $this->dispatchBrowserEvent('success', 'New community center added successfully!');

        $this->reset([
            'opening_hours',
            'closing_hours',
            'name',
            'state',
            'local_government',
            'town',
            'address'
        ]);
    }

    public function render()
    {
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $towns = (isset($this->local_government)) ? $this->towns($this->local_government) : [];
        $community_members = (isset($this->local_government)) ? $this->communityMembers($this->local_government) : [];

        title('Admin - Add Community Centers');

        return view(
            'livewire.admin.community-center.add',
            compact(
                'states',
                'local_governments',
                'towns',
                'community_members'
            )
        )
            ->extends('layouts.admin')
            ->section('content');
    }
}