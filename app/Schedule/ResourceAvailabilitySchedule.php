<?php


namespace App\Schedule;

use App\Enums\ResourceStatus;
use App\Mail\ResourceAvailable;
use App\Models\CommunityResource;
use App\Models\CommunityResourceLog;
use Illuminate\Support\Facades\Mail;

class ResourceAvailabilitySchedule
{
    public function __invoke()
    {
        $resources = CommunityResource::whereIn('status', [
            ResourceStatus::AVAILABLE,
            ResourceStatus::IN_USE
        ])->get();

        foreach ($resources as $resource) {
            if (ResourceStatus::tryFrom($resource->status) == ResourceStatus::AVAILABLE) {
                $wait_list = $resource->waitList;
                foreach ($wait_list as $waiter) {
                    if ($waiter->no_of_notified_times >= config("app.resource.sending_count", 1)) continue;
                    Mail::to($waiter->member)
                        ->send(
                            new ResourceAvailable($resource, $waiter->member)
                        );
                    $waiter->no_of_notified_times += 1;
                    $waiter->save();
                }

                CommunityResourceLog::where('resource_id', $resource->id)->update([
                    "check_out" => now()->format('Y-m-d H:i:s')
                ]);

                continue;
            }

            $resource_log = $resource->logs()->whereNull("check_out")->latest()->first();

            if ($resource_log) {
                $has_exhausted_usage_time = $this->checkMaxUsageTime(
                    $resource_log->check_in,
                    $resource->max_usage_time
                );

                if ($has_exhausted_usage_time) {
                    CommunityResourceLog::where('id', $resource_log->id)->update([
                        "check_out" => now()->format('Y-m-d H:i:s')
                    ]);
                }
            }
        }
    }

    public function checkMaxUsageTime($check_in_time, $max_usage_time) {
        $current_date_time = new \DateTime('now');
        $check_in_time = new \DateTime($check_in_time);
        $diffInSeconds = $current_date_time->getTimestamp() - $check_in_time->getTimestamp();
        $time_elapsed_in_minutes = $diffInSeconds / 60;
        if ($time_elapsed_in_minutes > $max_usage_time) {
            return true;
        } else {
            return false;
        }
    }
}