<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ScheduledExpense;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TransactionFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'canceled' => false,
            'description' => $this->faker->sentence,
        ];
    }
}
