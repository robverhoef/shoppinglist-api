<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShoppingItem>
 */
class ShoppingItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'quantity' => $this->faker->randomFloat(3, 0, 100),
            'unit' => $this->faker->randomElement(['kg', 'g', 'l', 'piece', 'pieces', 'item', 'items']),
            'checked' => $this->faker->boolean(0)
        ];
    }
}
