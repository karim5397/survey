<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public $order=1;
    public function run(): void
    {
        Question::create([
            'order'=>$this->order++,
            'questionnaire_id'=>1,
            'content'=>'What is your name',
            'type'=>'text',
        ]);
        Question::create([
            'order'=>$this->order++,
            'questionnaire_id'=>1,
            'content'=>'What is your age',
            'type'=>'number',
            'rules'=>json_encode(['numeric', 'min:1']),
        ]);
        Question::create([
            'order'=>$this->order++,
            'questionnaire_id'=>1,
            'content'=>'What is your gender',
            'type'=>'radio',
            'options'=>json_encode(['male', 'female']),
        ]);
    }
}
