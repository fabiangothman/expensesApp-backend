<?php

namespace Database\Factories;

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
        $randomExpenseGroupId = ExpenseGroup::inRandomOrder()->first('id');
        $randomExpenseCategoryId = ExpenseCategory::inRandomOrder()->first('id');

        return [
            'name' => "Scheduled expense ".$this->faker->word,
            'transaction_type' => $this->faker->randomElement(['IN', 'OUT']),   // ['IN', 'OUT', 'NONE']
            'value' => $this->faker->numberBetween(100, 10000),
            'frequency_type' => $this->faker->randomElement(['MONTHLY']),    // ['DAILY', 'MONTHLY', 'YEARLY']
            'frequency' => $this->faker->numberBetween(1, 30),
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeBetween('now', '2 years'),
            'active' => true,
            'expensegroup_id' => $randomExpenseGroupId,
            'expensecategory_id' => $randomExpenseCategoryId,
            'description' => $this->faker->sentence,
        ];
    }
}
