<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            AdminRoleSeeder::class,
            StateSeeder::class,
            LocalGovernmentSeeder::class,
            TownSeeder::class,
            SchoolSeeder::class,
            TertiaryInstitutionSeeder::class,
            SchoolSessionSeeder::class
        ]);
    }
}
