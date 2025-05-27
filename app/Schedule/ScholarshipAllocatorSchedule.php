<?php


namespace App\Schedule;

use App\Mail\ReceivedScholarship;
use App\Mail\ScholarshipAllocated;
use App\Models\Community;
use App\Models\ExamResult;
use App\Models\ScholarshipSlot;
use App\Models\Town;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ScholarshipAllocatorSchedule
{
    public function sendScholarshipMails($patron, $scholar)
    {
        Mail::to($scholar)->send(
            new ReceivedScholarship(
                $scholar
            )
        );

        Mail::to($patron)->send(
            new ScholarshipAllocated(
                $patron,
                $scholar
            )
        );
    }

    public function getHighRankedMembersForScholarship(Town $town, int $total_slots)
    {
        return ExamResult::join('exams', 'exam_results.exam_id', '=', 'exams.id')
            ->join('courses', 'exams.course_id', '=', 'courses.id')
            ->join('communities', 'exam_results.exam_resultable_id', '=', 'communities.id')
            ->where('courses.is_scholarship_course', true)
            ->where('communities.town_id', $town->id)
            ->where(function ($query) {
                $query->whereNotIn('exam_results.exam_resultable_id', function ($subquery) {
                    $subquery->select('beneficiary_id')->from('scholarship_slots')->whereNotNull('beneficiary_id');
                })->orWhereNull('exam_results.exam_resultable_id');
            })
            ->groupBy('courses.id', 'communities.town_id', 'communities.id')
            ->select(
                'courses.id as course_id',
                'courses.name as course_name',
                'exam_results.exam_resultable_id as member_id',
                'communities.town_id',
                'communities.id as member_id',
                DB::raw('MAX(exam_results.score) as max_result')
            )
            ->take($total_slots)
            ->get();
    }

    public static function getPatronMemberFromSlot($communities, $slot)
    {
        $member = null;
        if (isset($slot)) {
            $targetSlot = $slot;
            foreach ($communities as $community) {
                if ($community->patron->scholarshipSlots->contains('id', $targetSlot->id)) {
                    $member = $community;
                    break;
                }
            }
        }

        return $member;
    }

    // TODO : Implement allocation of this type of slots to top rank members that has not been allocated to
    public function getGeneralScholarshipSlots()
    {
        return ScholarshipSlot::where('is_active', true)
            ->whereNull('beneficiary_id')
            ->whereHas('patron', function ($query) {
                $query->whereNull('town_id');
            })
            ->with(['patron'])
            ->get();
    }

    public function __invoke()
    {
        $towns = Town::whereHas('communities.patron.scholarshipSlots', function ($query) {
            $query->where('is_active', true)->whereNotNull('town_id');
        })
            ->with(['communities.patron.scholarshipSlots'])
            ->get();

        // $general_slots_per_town = ceil(count($general_slots) / count($towns));
        foreach ($towns as $town) {
            $town_slots = $town->communities->flatMap(function ($community) {
                return $community->patron->scholarshipSlots;
            });

            $top_ranking_members = $this->getHighRankedMembersForScholarship(
                $town,
                count($town_slots)
            );

            foreach ($top_ranking_members as $key => $member) {
                $town_slots[$key]->update([
                    'beneficiary_id' => $member->member_id
                ]);

                $patronMember = $this->getPatronMemberFromSlot(
                    $town->communities,
                    $town_slots[$key]
                );

                $this->sendScholarshipMails(
                    $patronMember,
                    Community::find($member->member_id)
                );
                // Send patron and member email notification
            }
        }
    }
}