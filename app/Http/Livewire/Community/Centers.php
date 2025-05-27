<?php

namespace App\Http\Livewire\Community;

use App\Enums\ResourceStatus;
use App\Models\CommunityCenter;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\CommunityResource;
use App\Models\CommunityResourceLog;
use App\Models\CommunityResourceWaitList;

class Centers extends Component
{
    public $member;

    public $search;

    public $local_government;

    public $center_id;

    public $new_activity_check_in;

    public $new_activity_description;

    public CommunityCenter $selected_center;

    protected $queryString = ['center_id', 'search'];

    public CommunityResourceLog $latest_resource_activity;

    public function fetchMemberLogs($resource_id)
    {
        $this->new_activity_check_in = (new \DateTime('now'))->format('Y-m-d H:i:s');
    }


    public function addToWaitList(int $resource_id)
    {
        $waitListRecord = CommunityResourceWaitList::where('member_id', $this->member->id)
            ->where('resource_id', $resource_id)
            ->where('no_of_notified_times', 0)
            ->first();

        if ($waitListRecord) {
            $this->dispatchBrowserEvent('error', 'Already added to waitlist');
            return;
        }

        CommunityResourceWaitList::create([
            "member_id" => $this->member->id,
            "resource_id" => $resource_id
        ]);

        $this->dispatchBrowserEvent('success', 'Resource added to waitlist successful!');

        $this->emit('refresh');
    }

    public function convertTimeToFullDate($timeString) {
        $currentDateTime = new \DateTime('now');
        $timeDateTime = new \DateTime($timeString);
        $timeDateTime->setDate($currentDateTime->format('Y'), $currentDateTime->format('m'), $currentDateTime->format('d'));
        $fullDate = $timeDateTime->format('Y-m-d H:i:s');

        return $fullDate;
    }

    public function checkOut(int $log_id)
    {
        $log = CommunityResourceLog::find($log_id);
        $log->check_out = (new \DateTime('now'))->format('Y-m-d H:i:s');

        $resource = $log->resource;
        $resource->status = ResourceStatus::AVAILABLE;

        $resource->save();
        $log->save();

        $this->dispatchBrowserEvent('success', 'Check out successful!');
        $this->emit('refresh');
    }

    public function checkIn(int $resource_id)
    {
        $resource = CommunityResource::where('id', $resource_id)->first();
        if (ResourceStatus::tryFrom($resource->status) != ResourceStatus::AVAILABLE) {
            $this->dispatchBrowserEvent('error', "Resource is already in use");
            return;
        }

        $resource->status = ResourceStatus::IN_USE;

        $activity = new CommunityResourceLog();
        $activity->action = "community-use";
        $activity->resource_id = $resource_id;
        $activity->owner_id = $this->member->id;
        $activity->check_in = $this->new_activity_check_in;
        $activity->description = $this->new_activity_description;

        $resource->save();
        $activity->save();
    }

    public function render()
    {

        $this->member = Auth::guard('community')->user();

        $centers = CommunityCenter::where('local_government_id', $this->member->local_government_id)->get();

        if (!$this->center_id && count($centers) > 0) {
            $this->center_id = $centers[0]->id;
            $this->selected_center = $centers[0];
        } else {
            $this->selected_center = CommunityCenter::find($this->center_id);
        }


        $my_id = $this->member->id;
        $resource_statuses = ResourceStatus::class;
        $total = CommunityResource::count();
        $search = CommunityResource::query();
        $resources = $search->where(function($query) {
            $query->whereIn('status', [ResourceStatus::AVAILABLE, ResourceStatus::IN_USE]);
            $query->whereHas('type', function($typeQuery) {
                $typeQuery->where('name', 'like', '%'.$this->search.'%');
            });
            $query->where('community_center_id', $this->center_id);
        })
            ->latest()
            ->paginate();

            // For the time slot thing, based on the resource and waiting list, generate available time slots for each resource
            // fetch all resource logs starting from today;
            // close all previous day logs

        title('Community Centers');

        return view('livewire.community.centers', compact('my_id', 'resources', 'centers', 'resource_statuses' ))
            ->extends('layouts.community')
            ->section('content');
    }
}