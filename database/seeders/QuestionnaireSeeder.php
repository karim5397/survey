<?php

namespace Database\Seeders;

use App\Models\Questionnaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Questionnaire::create([
            'name'=>'Personal Information Questionnaire',
            'description'=>'Its a quick questionnaire about user information',
            'user_id'=>1,
            'is_active'=>true,
        ]);
    }
}
