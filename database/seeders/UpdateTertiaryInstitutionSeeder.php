<?php

namespace Database\Seeders;

use App\Models\Town;
use App\Models\State;
use App\Models\LocalGovernment;
use App\Models\TertiaryInstitution;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateTertiaryInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tertiary_institutions = TertiaryInstitution::all();

        foreach ($tertiary_institutions as $tertiary_institution) {
            $tertiary_institution->state_id = $this->getStateId($tertiary_institution->state);
            $tertiary_institution->local_government_id = $this->getLocalGovernmentId($tertiary_institution->local_government);
            $tertiary_institution->town_id = $this->getTownId($tertiary_institution->town);

            $tertiary_institution->save();
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
