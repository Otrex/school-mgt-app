<?php

namespace Database\Seeders;

use App\Models\TertiaryInstitution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TertiaryInstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TertiaryInstitution::create([
            'name' => 'Nnamdi Azikiwe University',
            'state' => 'Anambra',
            'local_government' => 'Awka South',
            'town' => 'Awka',
        ]);

        TertiaryInstitution::create([
            'name' => 'Chukwuemeka Odumegwu Ojukwu University',
            'state' => 'Anambra',
            'local_government' => 'Ihiala',
            'town' => 'Uli',
        ]);

        TertiaryInstitution::create([
            'name' => 'St. Paul University',
            'state' => 'Anambra',
            'local_government' => 'Awka South',
            'town' => 'Awka',
        ]);

        TertiaryInstitution::create([
            'name' => 'Madonna University',
            'state' => 'Anambra',
            'local_government' => 'Ihiala',
            'town' => 'Okija',
        ]);

        TertiaryInstitution::create([
            'name' => 'Legacy University',
            'state' => 'Anambra',
            'local_government' => 'Ihiala',
            'town' => 'Okija',
        ]);

        TertiaryInstitution::create([
            'name' => 'Tansian University',
            'state' => 'Anambra',
            'local_government' => 'Oyi',
            'town' => 'Umunya',
        ]);

        TertiaryInstitution::create([
            'name' => 'Nwafor Orizu College Of Education',
            'state' => 'Anambra',
            'local_government' => 'Anambra East',
            'town' => 'Nsugbe',
        ]);

        TertiaryInstitution::create([
            'name' => 'Federal College Of Education (Technical)',
            'state' => 'Anambra',
            'local_government' => 'Orumba South',
            'town' => 'Umunzem',
        ]);

        TertiaryInstitution::create([
            'name' => 'Anambra State Polytechnic',
            'state' => 'Anambra',
            'local_government' => 'Awka North',
            'town' => 'Mgbakwu',
        ]);
    }
}
