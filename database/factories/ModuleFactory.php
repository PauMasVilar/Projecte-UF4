<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_course' => Course::inRandomOrder()->first()->id,
            "name" => fake()->name,
            "description" => fake()->sentence(rand(5, 35)),
            "created_at" => fake()->dateTime(),
            "updated_at" => fake()->dateTime(),
        ];
    }
}
