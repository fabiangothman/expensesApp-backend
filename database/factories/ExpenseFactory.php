<?php

namespace Database\Factories;

use App\Models\ExpenseCategory;
use App\Models\ExpenseGroup;
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
        $randomExpenseGroupId = ExpenseGroup::inRandomOrder()->first('id');
        $randomExpenseCategoryId = ExpenseCategory::inRandomOrder()->first('id');

        return [
            'name' => "Manual expense ".$this->faker->word,
            'date' => $this->faker->dateTimeBetween('-30 years', 'now'),
            'transaction_type' => $this->faker->randomElement(['IN', 'OUT']),   // 'NONE'
            'value' => $this->faker->numberBetween(100, 10000),
            'expensegroup_id' => $randomExpenseGroupId,
            'expensecategory_id' => $randomExpenseCategoryId,
            'description' => $this->faker->sentence,
        ];
    }
}
