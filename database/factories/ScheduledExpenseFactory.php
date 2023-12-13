<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ScheduledExpenseFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Scheduled expense ".$this->faker->word,
            'frequency_type' => $this->faker->randomElement(['MONTHLY']),    // ['DAILY', 'MONTHLY', 'YEARLY']
            'frequency' => $this->faker->numberBetween(1, 30),
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeBetween('now', '2 years'),
            'expense_id' => Expense::factory(),
            'active' => true,
            'description' => $this->faker->sentence,
        ];
    }

    public function withExistentExpenseGroupAndCategory()
    {
        return $this->state(function (array $attributes) {
            return [
                'expense_id' => Expense::factory()->withExistentGroupAndCategory(),
            ];
        });
    }
}
