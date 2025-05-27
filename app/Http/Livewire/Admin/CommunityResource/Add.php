<?php

namespace App\Http\Livewire\Admin\CommunityResource;

use App\Enums\ResourceStatus;
use Livewire\Component;
use App\Models\CommunityCenter;
use App\Models\CommunityResource;
use App\Traits\LocalGovernmentTown;

class Add extends Component
{
    use LocalGovernmentTown;

    public $serial_number;
    public $description;
    public $type;
    public $status;
    public $max_usage_time;
    public $center;
    public $state;
    public $local_government;

    protected array $rules = [
        'serial_number' => 'required|string',
        'max_usage_time' => 'required|int',
        'description' => 'string',
        'type' => 'required|string',
        'center' => 'required',
        'status' => 'string',
    ];

    public function add()
    {
        $this->validate();

        CommunityResource::create([
            'community_center_id' => $this->center,
            'serial_number' => $this->serial_number,
            'description' => $this->description,
            'status' => $this->status,
            'type' =>  strtolower($this->type),
            'max_usage_time' => $this->max_usage_time,
        ]);

        $this->dispatchBrowserEvent('success', 'New community resource added successfully!');

        $this->reset([
            'max_usage_time',
            'serial_number',
            'description',
            'type',
            'state',
            'center'
        ]);
    }

    public function render()
    {
        $statuses = ResourceStatus::getValues();
        $states = $this->states();
        $local_governments = (isset($this->state)) ? $this->localGovernments($this->state) : [];
        $centers = (isset($this->local_government)) ? $this->communityCenters($this->local_government) : [];

        title('Admin - Add Community Resource/Assets');

        return view(
            'livewire.admin.community-resource.add',
            compact(
                'states',
                'local_governments',
                'centers',
                'statuses'
            )
        )
            ->extends('layouts.admin')
            ->section('content');
    }
}