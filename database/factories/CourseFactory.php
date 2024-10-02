<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_professor' => User::inRandomOrder()->first()->id,
            "name" => fake()->name,
            "description" => fake()->sentence(rand(5, 20)),
            "duration" => fake()->numberBetween(5, 250),
            "start_date" => fake()->dateTimeBetween('now', '+10 days'),
            "end_date" => fake()->dateTimeBetween('+10 days', '+90 days'),
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),
        ];
    }
}
