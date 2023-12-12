<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ExpenseCategory;
use App\Models\ExpenseGroup;
use App\Models\ExpenseGroupUser;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creates first only some 'free' categories
        $parentCategories = ExpenseCategory::factory(5)->create();
        $childCategories = [];
        foreach ($parentCategories as $key => $parentCategory) {
            $childCategories = ExpenseCategory::factory(2)->create([
                'name' => $parentCategory->name."'s child",
                'parentcategory_id' => $parentCategory->id
            ]);
        }

        //Creates some 'attached' categories to the child level
        ExpenseCategory::factory(2)->create([
            'name' => "Random child",
            'expensegroup_id' => ExpenseGroup::factory(),
            'parentcategory_id' => $childCategories->random()->id,
        ]);

        // Creates some ExpenseGroupUser samples (it will create ExpenseGroup, User and MoneyBox)
        ExpenseGroupUser::factory(2)->create();
        // But also gets some users for the already created groups
        ExpenseGroupUser::factory(2)->withRandomExpenseGroup()->create();

        //Now creates some dummy Transactions (it will create Expense or ScheduledExpense)
        Transaction::factory(20)->withScheduledExpense()->create();
        Transaction::factory(20)->withExpense()->create();

        //  User::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
