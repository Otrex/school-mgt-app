<?php

namespace Database\Seeders;

use App\Models\CourseContentsLanguages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseContentsLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CourseContentsLanguages::create([
            'language' => 'English',
        ]);

        CourseContentsLanguages::create([
            'language' => 'Igbo',
        ]);

        CourseContentsLanguages::create([
            'language' => 'Yoruba',
        ]);

        CourseContentsLanguages::create([
            'language' => 'Hausa',
        ]);
    }
}
