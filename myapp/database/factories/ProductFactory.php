<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'category_id' => fake()->numberBetween(1, 5),
            'brand_id' => fake()->numberBetween(1, 5),
            'price' => fake()->randomFloat(2, 100, 10000),
            'quantity' => fake()->numberBetween(1, 100),
            'reorder_level' => fake()->numberBetween(5, 10),
            'description' => fake()->paragraph(),
            'active' => fake()->numberBetween(0, 1),
            'image' => null, // You can set a default image path or leave it as null
        ];
    }
}
