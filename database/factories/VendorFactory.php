<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendor>
 */
class VendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'full_name' => fake()->name(),
            'bio' => fake()->word(7),
            'status' => fake()->boolean(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->numerify('059#######'),
            'user_id' => function () {
                return \App\Models\User::factory(1)->create()->pluck('user_id')[0];
            }
        ];
    }
}
