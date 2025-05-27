<?php

namespace App\Http\Livewire\Community;

use App\Enums\ResourceStatus;
use App\Models\CommunityCenter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityResource;
use App\Models\CommunityResourceLog;

class Resources extends Component
{
    public $member;
    public $search;
    public $center_id;
    public $local_government;
    public $new_activity_check_in;
    public $new_activity_description;
    public CommunityResourceLog $latest_resource_activity;

    protected $rules = [
        "latest_resource_activity.check_out" => 'date_format:H:i'
    ];

    public function fetchMemberLogs($resource_id)
    {
        $log = CommunityResourceLog::where('resource_id', $resource_id)->latest()->first();
        if ($log && $log->owner_id == $this->member->id) {
            $this->latest_resource_activity = $log;
        }
    }

    public function convertTimeToFullDate($timeString) {
        $currentDateTime = new \DateTime('now');
        $timeDateTime = new \DateTime($timeString);
        $timeDateTime->setDate(
            $currentDateTime->format('Y'),
            $currentDateTime->format('m'),
            $currentDateTime->format('d')
        );
        $fullDate = $timeDateTime->format('Y-m-d H:i:s');

        return $fullDate;
    }

    public function checkOut()
    {
        $this->latest_resource_activity->check_out = $this->convertTimeToFullDate($this->latest_resource_activity->check_out);
        $this->latest_resource_activity->save();
    }

    public function checkIn(int $resource_id)
    {
        $resource = CommunityResource::where('id', $resource_id)->first();
        if ($resource->status != ResourceStatus::AVAILABLE) {
            $this->dispatchBrowserEvent('error', "Resource is already in use");
            return;
        }

        $resource->status = ResourceStatus::IN_USE;
        $resource->save();
        $activity = new CommunityResourceLog();
        $activity->action = "community-use";
        $activity->resource_id = $resource_id;
        $activity->description = $this->new_activity_description;
        $activity->owner_id = $this->member->id;

        $activity->save();
    }

    public function render()
    {
        $this->member = Auth::guard('community')->user();
        $centers = CommunityCenter::where('local_government_id', $this->member->local_government_id)->get();
        if (!$this->center_id && count($centers) > 0) {
            $this->center_id = $centers[0]->id;
        }

        $search = CommunityResource::query();
        $total = CommunityResource::count();
        $resources = $search->where(function($query) {
            $query->whereHas('type', function($typeQuery) {
                $typeQuery->where('name', 'like', '%'.$this->search.'%');
            });
            $query->where('community_center_id', $this->center_id);
        })
            ->latest()
            ->paginate();

        title('Community Resources');

        return view('livewire.community.resources', compact('resources', 'centers'))
            ->extends('layouts.community')
            ->section('content');
    }
}