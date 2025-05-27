<?php

namespace App\Http\Livewire\Admin\CommunityResource;

use App\Enums\ResourceStatus;
use Livewire\Component;
use App\Models\CommunityCenter;
use App\Models\CommunityResource;
use App\Models\ResourceType;
use App\Traits\MediaUpload;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, MediaUpload;

    public CommunityResource $resource;

    public $image;

    protected $rules = [
        'resource.community_center_id' => 'required|string',
        'resource.serial_number' => 'required|string',
        'resource.max_usage_time' => 'required|string',
        'resource.description' => 'required|string',
        'resource.status' => 'required|string',
        'resource.type_id' => 'required',
        'image' => 'required'
    ];

    protected $listeners = [
        'refresh' => 'render'
    ];

    public function update()
    {
        $this->resource->save();

        if ($this->image) {
            $image = $this->uploadSingleImage($this->image) ?? null;

            CommunityResource::where('id', $this->resource->id)->update([
                'image' => $image
            ]);

        }


        $this->emit('refresh');

        $this->dispatchBrowserEvent(
            'success',
            "Updated successfully!"
        );
    }

    public function render()
    {
        $centers = CommunityCenter::all();

        $statuses = ResourceStatus::getValues();

        $resource_types = ResourceType::all();

        title('Admin - Edit Community Resource');

        return view('livewire.admin.community-resource.edit', [

            'centers' => $centers,

            'statuses' => $statuses,

            'resource_types' => $resource_types

        ])
            ->extends('layouts.admin')

            ->section('content');
    }
}