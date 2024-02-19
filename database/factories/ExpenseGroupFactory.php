<?php

namespace Database\Factories;

use App\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExpenseGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word()."'s group",
            'group_key' => $this->faker->unique()->regexify('[A-Za-z0-9]{40}'),
            'currency_id' => Currency::factory(),
            'description' => fake()->sentence(),
        ];
    }
}
