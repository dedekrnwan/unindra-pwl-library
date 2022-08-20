<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookTurnover>
 */
class BookTurnoverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'book_id' => $this->faker->numberBetween(1, 103),
            'user_id' => $this->faker->numberBetween(1, 20),
            'user_loan_id' => $this->faker->numberBetween(1, 50),
            'cash_amount' => $this->faker->numberBetween(50000, 100000),
            'quantity' => $this->faker->numberBetween(1,2),
            'cash_amount' => 50000,
        ];
    }
}
