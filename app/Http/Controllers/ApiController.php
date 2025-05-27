<?php

namespace App\Http\Controllers;

use App\Enums\ResourceStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Community;
use App\Models\LocalGovernment;
use App\Models\CommunityCenter;
use App\Models\CommunityResource;
use App\Models\ResourceType;
use App\Models\State;
use App\Traits\ApiUtilities;

class ApiController extends Controller
{
    use ApiUtilities;

    public function getStates()
    {
        return $this->respond([
            "states" => State::all()
        ]);
    }

    public function getResourceTypes()
    {
        return $this->respond([
            "resource_types" => ResourceType::all()
        ]);
    }

    public function getLGAByState(string $stateId)
    {
        return $this->respond([
            "local_governments" => LocalGovernment::where('state_id', $stateId)->get()
        ]);
    }

    public function getLGAStats(string $localGovernmentId)
    {
        return $this->respond([
            "total_community_centers" => CommunityCenter::where('local_government_id', $localGovernmentId)->count(),
            "total_enrollments" => LocalGovernment::find($localGovernmentId)->communities()->count()
        ]);
    }

    public function getEnrolmentStats(Request $request, string $localGovernmentId)
    {
        $errors = $this->apiValidate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        if ($errors != null) {
            return $this->errorResponse($errors);
        }

        $query = $request->query();

        $enrollmentData = Community::where('local_government_id', $localGovernmentId)
            ->whereBetween('email_verified_at', [
                $query['start_date'],
                $query['end_date']
            ])
            ->get();

        $monthlyBreakdown = $enrollmentData->groupBy(function ($member) {
            return Carbon::parse($member->email_verified_at)
                ->format('Y_m');
        })->map->count();


        return $this->respond([
            "breakdown" => $monthlyBreakdown,
        ]);
    }

    public function getEnrolmentPercentageIncrease(Request $request, string $localGovernmentId)
    {
        $errors = $this->apiValidate($request, [
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'compare_start_date' => 'required|date',
            'compare_end_date' => 'required|date',
        ]);

        if ($errors != null) {
            return response()->json([
                'error' => $errors
            ], 422);
        }

        $query = $request->query();

        $currentEnrollees = Community::where('local_government_id', $localGovernmentId)
            ->whereBetween('email_verified_at', [
                $query['start_date'],
                $query['end_date']
            ])
            ->count();

        $previousEnrollees = Community::where('local_government_id', $localGovernmentId)
            ->whereBetween('email_verified_at', [
                $query['compare_start_date'],
                $query['compare_end_date']
            ])
            ->count();

        $percentageIncrease = 0;
        if ($previousEnrollees > 0) {
            $percentageIncrease = (($currentEnrollees - $previousEnrollees) / $previousEnrollees) * 100;
        }

        return $this->respond([
            "percentage_increase" => $percentageIncrease,
            "compare_range_total" => $previousEnrollees,
            "main_range_total" => $currentEnrollees,
        ]);
    }

    public function getTotalActiveResourceInLGA(Request $request, string $localGovernmentId)
    {
        $errors = $this->apiValidate($request, [
            'type_id' => 'required|string',
            'status' => [new Enum(ResourceStatus::class)]
        ]);

        if ($errors != null) {
            return response()->json([
                'error' => $errors
            ], 422);
        }

        $query = $request->query();

        $localGovernment = LocalGovernment::find($localGovernmentId)->first();

        if ($localGovernment == null) {
            return $this->errorResponse('Local Government not found');
        }

        $communityResources = CommunityResource::where('type_id', $query['type_id'])
            ->whereHas('communityCenter', function ($query) use ($localGovernmentId) {
                $query->where('local_government_id', $localGovernmentId);
            })
            ->count();

        return $this->respond([
            "total_resource" => $communityResources
        ]);
    }

    public function rankEnrollees(Request $request, string $localGovernmentId, string $courseId)
    {
        $errors = $this->apiValidate($request, [
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:1900',
        ]);

        if ($errors != null) {
            return response()->json([
                'error' => $errors
            ], 422);
        }

        $targetDate = (new \DateTime())->setDate($request->year, $request->month, 1)->format('Y-m-d');

        $enrollees = Community::join('results', 'communities.id', '=', 'results.community_id')
            ->where('communities.local_government_id', (int) $localGovernmentId)
            ->where('results.course_id', $courseId)
            ->whereDate('results.created_at', '>=', $targetDate)
            ->select(
                'results.score',
                'communities.first_name',
                'communities.last_name',
                'communities.email',
                'communities.gender',
                'communities.phone',
                'communities.image'
            )
            ->orderByDesc('score')
            ->get();


        $rankedEnrollees = $enrollees->map(function ($enrollee, $index) {
            $enrollee->rank = $index + 1;
            return $enrollee;
        });

        return $this->respond([
            "ranked_enrollees" => $rankedEnrollees
        ]);

    }
}