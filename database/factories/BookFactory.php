<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->domainWord(),
            'writer' => $this->faker->name(),
            'publisher' => $this->faker->company(),
            'publish_year' => $this->faker->year(),
            'stock' => $this->faker->numberBetween(14, 89),
            'category' => $this->faker->country(),
            'price' => 50000,
        ];
    }
}
