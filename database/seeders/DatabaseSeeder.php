<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\ExpenseGroup;
use App\Models\ExpenseGroupUser;
use App\Models\ScheduledExpense;
use App\Models\Transaction;
use App\Models\User;
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

        // Creates some ExpenseGroupUser samples (it will create ExpenseGroup, User and Currency)
        ExpenseGroupUser::factory(2)->create();
        // But also gets some users for the already created groups
        ExpenseGroupUser::factory(2)->withRandomExpenseGroup()->create();

        // Creates some the ScheduledExpense and Expense samples (using the already created Categories and ExpenseGroups)
        $scheduledExpenses = ScheduledExpense::factory(4)->withExistentExpenseGroupAndCategory()->create();
        $expenses = Expense::factory(20)->withExistentGroupAndCategory()->create();

        //Now creates the transaction for each one of the Expenses
        foreach ($scheduledExpenses as $key => $scheduledExpense) {
            Transaction::factory()->create([
                'expense_id' => $scheduledExpense->expense_id,
            ]);
        }
        foreach ($expenses as $key => $expense) {
            Transaction::factory()->create([
                'expense_id' => $expense->id,
            ]);
        }

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password' => '123456',
            'role' => 'user',
        ]);
    }
}
