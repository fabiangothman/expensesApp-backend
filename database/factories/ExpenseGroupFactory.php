<?php

namespace Database\Factories;

use App\Models\MoneyBox;
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
            'name' => fake()->word()."'s box",
            'group_key' => $this->faker->unique()->regexify('[A-Za-z0-9]{40}'),
            'moneybox_id' => MoneyBox::factory(),
        ];
    }
}
