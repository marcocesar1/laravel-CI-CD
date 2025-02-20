<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'total' => $this->faker->randomFloat(2, 100, 1000),
            'address' => [
                'street' => $this->faker->streetAddress,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'zip' => $this->faker->postcode,
            ],
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed']),
            /* 'user_id' => User::factory(), */
        ];
    }
}
