<?php

namespace Database\Seeders;

use App\Models\LocalGovernment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalGovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $local_gvmts = [
            'Aguata',
            'Anambra East',
            'Anambra West',
            'Anaocha',
            'Awka North',
            'Awka South',
            'Ayamelum',
            'Dunukofia',
            'Ekwusigo',
            'Idemili North',
            'Idemili South',
            'Ihiala',
            'Njikoka',
            'Nnewi North',
            'Nnewi South',
            'Ogbaru',
            'Onitsha North',
            'Onitsha South',
            'Orumba North',
            'Orumba South',
            'Oyi',
        ];

        foreach ($local_gvmts as $lga ) {
            LocalGovernment::create([
                'state_id' => 4,
                'name' => $lga
            ]);
        }
    }
}
