<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(5),
            'brief' => fake()->sentence(12, true),
            'description' => fake()->sentence(25),
            'description' => fake()->sentence(25),
            'status' => fake()->boolean(),
        ];
    }
}
