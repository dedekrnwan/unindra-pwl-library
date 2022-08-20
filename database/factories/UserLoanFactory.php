<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserLoan>
 */
class UserLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'effective_date' => $this->faker->date('Y-m-d', Date::now()->addDays(-19)),
            'expired_date' => $this->faker->dateTimeBetween(Date::now()->addDays(-5), Date::now()),
            'user_id' => $this->faker->numberBetween(1, 20),
            'book_id' => $this->faker->numberBetween(1, 103),
            'quantity' => $this->faker->numberBetween(1,2),
            'status' => 'borrowed',
        ];
    }
}
