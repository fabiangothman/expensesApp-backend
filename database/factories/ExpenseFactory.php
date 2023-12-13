<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\ExpenseGroup;
use App\Models\ScheduledExpense;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExpenseFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "Manual expense ".$this->faker->word,
            'date' => $this->faker->dateTimeBetween('-30 years', 'now'),
            'transaction_type' => $this->faker->randomElement(['IN', 'OUT']),   // ['IN', 'OUT', 'NONE']
            'value' => $this->faker->numberBetween(100, 10000),
            'processed' => $this->faker->boolean,
            'expensegroup_id' => ExpenseGroup::factory(),
            'expensecategory_id' => ExpenseCategory::factory(),
            'description' => $this->faker->sentence,
        ];
    }

    public function withExistentGroupAndCategory()
    {
        $randomExpenseGroupId = ExpenseGroup::inRandomOrder()->first('id');
        $randomExpenseCategoryId = ExpenseCategory::inRandomOrder()->first('id');

        return $this->state(function (array $attributes) use ($randomExpenseGroupId, $randomExpenseCategoryId) {
            return [
                'expensegroup_id' => $randomExpenseGroupId,
                'expensecategory_id' => $randomExpenseCategoryId,
            ];
        });
    }
}
