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
            'scheduledexpense_id' => null,
            'expense_id' => Expense::factory(),
            'canceled' => false,
            'description' => $this->faker->sentence,
        ];
    }

    public function withScheduledExpense()
    {
        return $this->state(function (array $attributes) {
            return [
                'scheduledexpense_id' => ScheduledExpense::factory(),
                'expense_id' => null,
            ];
        });
    }

    public function withExpense()
    {
        return $this->state(function (array $attributes) {
            return [
                'scheduledexpense_id' => null,
                'expense_id' => Expense::factory(),
            ];
        });
    }
}
