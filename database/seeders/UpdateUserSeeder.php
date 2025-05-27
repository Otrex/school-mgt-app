<?php

namespace Database\Seeders;

use App\Models\Town;
use App\Models\State;
use App\Models\LocalGovernment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->state_id = $this->getStateId($user->state);
            $user->local_government_id = $this->getLocalGovernmentId($user->local_government);
            $user->town_id = $this->getTownId($user->town);

            $user->save();
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
