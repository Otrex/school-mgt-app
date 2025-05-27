<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Town;
use App\Models\State;
use App\Models\LocalGovernment;
use App\Models\TertiaryInstitution;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateCommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $community_members = Community::all();

        foreach ($community_members as $community_member) {
            $community_member->state_id = $this->getStateId($community_member->state);
            $community_member->local_government_id = $this->getLocalGovernmentId($community_member->local_government);
            if (Town::where('name', $community_member->town)->get()->count() == 0) {
                $community_member->tertiary_institution_id = $this->getTertiaryInstitutionId($community_member->town);
                $community_member->is_tertiary_institution = true;
            } else {
                $community_member->town_id = $this->getTownId($community_member->town);
            }


            $community_member->save();
        }
    }

    public function getStateId($state_name)
    {
        return State::where('name', $state_name)->first()->id;
    }

    public function getLocalGovernmentId($local_government_name)
    {
        return LocalGovernment::where('name', $local_government_name)->first()->id;
    }

    public function getTownId($town_name)
    {
        return Town::where('name', $town_name)->first()->id;
    }

    public function getTertiaryInstitutionId($tertiary_institution_name)
    {
        return TertiaryInstitution::where('name', $tertiary_institution_name)->first()->id;
    }
}
