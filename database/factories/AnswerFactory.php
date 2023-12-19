<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();

        $entryIds = Entry::pluck('id')->toArray();
        $questionIds = Question::pluck('id')->toArray();

        return [
            'entry_id' => $faker->randomElement($entryIds),
            'question_id' => $faker->randomElement($questionIds),
            'value' => $faker->word(),
            'created_at' => $faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
