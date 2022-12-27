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
        static $count = 1;

        return [
            'full_name' => fake()->name(),
            'bio' => fake()->sentence(6, true),
            'status' => fake()->boolean(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->numerify('+97059#######'),
            'profile_image' => $count++,
            'user_id' => function () {
                return \App\Models\User::factory(1)->create()->pluck('user_id')[0];
            }
        ];
    }
}
