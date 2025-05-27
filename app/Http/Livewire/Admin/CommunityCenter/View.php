<?php

namespace App\Http\Livewire\Admin\CommunityCenter;

use App\Enums\ResourceStatus;
use App\Models\CommunityCenter;
use App\Models\CommunityResource;
use App\Models\ResourceType;
use Livewire\Component;
use App\Traits\LocalGovernmentTown;
use App\Traits\MediaUpload;
use Livewire\WithFileUploads;

class View extends Component
{
    use LocalGovernmentTown, WithFileUploads, MediaUpload;

    public CommunityCenter $center;
    public $search;
    public $status;
    public $description;
    public $type_id;
    public $image;
    public $max_usage_time;
    public $serial_number;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function deleteResource($id)
    {
        if (isset($id)) {
            $resource = CommunityResource::find($id);
            $resource->delete();
            $this->dispatchBrowserEvent('success', 'Resource deleted successfully!');
        }
    }

    protected array $rules = [
        'center.name' => 'required|string',
        'center.state_id' => 'required',
        'center.local_government_id' => 'required',
        'center.town_id' => 'required',
        'center.manager_id' => '',
        'center.opening_hours' => 'required|string',
        'center.closing_hours' => 'required|string',
        'center.address' => 'required|string',
        'center.is_active' => 'required|boolean',
    ];

    public function addResource()
    {
        $image = $this->uploadSingleImage($this->image);

        CommunityResource::create([
            'image' => $image,
            'status' => $this->status,
            'type_id' => $this->type_id,
            'description' => $this->description,
            'serial_number' => $this->serial_number,
            'community_center_id' => $this->center->id,
            'max_usage_time' => $this->max_usage_time,

        ]);

        $this->dispatchBrowserEvent('success', 'Community Resource saved successfully');

        $this->status = null;
        $this->image = null;
        $this->type_id = null;
        $this->description = null;
        $this->serial_number = null;
        $this->max_usage_time = null;
    }

    public function saveCenter()
    {
        $this->validate();

        if ($this->center->manager_id == '' || !$this->center->manager_id) {
            $this->center->manager_id = null;
        }

        $this->center->save();
        $this->dispatchBrowserEvent('success', 'Community Center updated successfully');
    }

    public function render()
    {
        $states = $this->states();
        $resource_types = ResourceType::all();
        $local_governments = (isset($this->center->state_id)) ? $this->localGovernments($this->center->state_id) : [];
        $towns = (isset($this->center->local_government_id)) ? $this->towns($this->center->local_government_id) : [];
        $members = (isset($this->center->local_government_id)) ? $this->communityMembers($this->center->local_government_id) : [];
        $centers = (isset($this->local_government)) ? $this->communityCenters($this->local_government) : [];
        $searchResource = CommunityResource::query();
        $statuses = ResourceStatus::getValues();

        $resources = $searchResource->where(function($query) {
            $query->whereHas('type', function($typeQuery) {
                $typeQuery->where('name', 'like', '%'.$this->search.'%');
            });
            $query->where('community_center_id', $this->center->id);
        })
            ->latest()
            ->paginate();

        title('Admin - View Community Center ('.$this->center->name.')');

        return view(
            'livewire.admin.community-center.view',
            compact(
                'states',
                'local_governments',
                'members',
                'towns',
                'resources',
                'centers',
                'statuses',
                'resource_types'
            ))

            ->extends('layouts.admin')
            ->section('content');
    }
}