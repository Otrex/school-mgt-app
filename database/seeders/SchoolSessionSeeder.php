<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Session::create([
            'session' => '2022/2023',
            'start_date' => '2022-07-06',
            'end_date' => '2023-07-06',
            'default' => true
        ]);

        Session::create([
            'session' => '2023/2024',
            'start_date' => '2023-07-06',
            'end_date' => '2024-07-06',
            'default' => false
        ]);
    }
}
