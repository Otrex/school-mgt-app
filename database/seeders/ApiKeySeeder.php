<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\ApiKey;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apiKeys = ApiKey::all();
        if (count($apiKeys) < 1) {
            ApiKey::create([
                'key' => config('app.api_secret'),
                'secret' => Hash::make(config('app.api_key')),
            ]);
        }
    }
}
