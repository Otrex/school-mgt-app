<?php

namespace App\Traits;

use App\Models\Community;
use App\Models\CommunityCenter;
use App\Models\LocalGovernment;
use App\Models\School;
use App\Models\State;
use App\Models\TertiaryInstitution;
use App\Models\Town;

trait LocalGovernmentTown
{

    public function states()
    {
        $states = State::all();

        return $states;
    }

    /**
     * Fetch all local government in anambra state
     */
    public function localGovernments($state_id)
    {
        $local_governments = [];

        $local_governments = LocalGovernment::where('state_id', $state_id)->get();

        return $local_governments;
    }


    public function communityMembers($lga_id)
    {
        $community_members = [];

        $community_members = Community::where('local_government_id', $lga_id)
            ->whereNotNull('email_verified_at')
            ->get();

        return $community_members;
    }

    /**
     * Fetch all town associated with a local government
     * @param string $lga_name Name of local government
     */
    public function towns($lga_id)
    {
        $towns = [];

        $towns = Town::where('local_government_id', $lga_id)->get();

        return $towns;
    }

    public function communityCenters($lga_id) {
        $centers = [];

        $centers = CommunityCenter::where('local_government_id', $lga_id)->get();

        return $centers;
    }

    public function getStateName($state_id)
    {
        return State::where('id', $state_id)->first()->name ?? null;
    }

    public function getLocalGovernmentName($local_government_id)
    {
        return LocalGovernment::where('id', $local_government_id)->first()->name ?? null;
    }

    public function getTownName($town_id)
    {
        return Town::where('id', $town_id)->first()->name ?? null;
    }

    public function getSchoolName($school_id)
    {
        return School::where('id', $school_id)->first()->name ?? null;
    }

    public function getTertiaryInstitutionName($tertiary_institution_id)
    {
        return TertiaryInstitution::where('id', $tertiary_institution_id)->first()->name ?? null;
    }
}
