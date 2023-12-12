<?php

namespace Database\Factories;

use App\Models\ExpenseGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ExpenseGroupUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'expensegroup_id' => ExpenseGroup::factory(),
        ];
    }

    public function withRandomExpenseGroup()
    {
        return $this->state(function (array $attributes) {
            $randomExpenseGroupId = ExpenseGroup::inRandomOrder()->first('id');

            return [
                'expensegroup_id' => $randomExpenseGroupId,
            ];
        });
    }
}
