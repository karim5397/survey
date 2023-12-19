<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            QuestionnaireSeeder::class,
            QuestionSeeder::class,
            EntrySeeder::class,
        ]);
        Answer::factory()->count(10)->create();
    }
}
