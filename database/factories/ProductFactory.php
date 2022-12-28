<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->sentence(12, true),
            'price' => fake()->numberBetween(1, 25),
            'status' => fake()->boolean(),
            'vendor_id' => Vendor::all()->random()->vendor_id,
        ];
    }
}
