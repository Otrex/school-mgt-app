<?php

namespace Database\Seeders;

use App\Models\LocalGovernment;
use App\Models\School;
use App\Models\State;
use App\Models\Town;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpdateSchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();

        foreach ($schools as $school) {
            $school->state_id = $this->getStateId($school->state);
            $school->local_government_id = $this->getLocalGovernmentId($school->local_government);
            $school->town_id = $this->getTownId($school->town);

            $school->save();
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
}
