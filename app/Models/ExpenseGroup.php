<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseGroup extends Model
{
    use HasFactory;

    protected $timestamps = true;
    protected $fillable = [
        'name',
        'group_key',
        'moneybox_id',
    ];
    protected $casts = [
        'group_key' => 'hashed',
    ];


    /**
     * expensegroup relationship to moneyBox.
     */
    public function moneyBox()
    {
        return $this->belongsTo(MoneyBox::class, 'moneybox_id');
    }

    /**
     * expensegroup relationship to all expenseCategories.
     */
    public function expenseCategories()
    {
        return $this->hasMany(ExpenseCategory::class, 'expensegroup_id');
    }

    /**
     * expensegroup relationship to all expenses.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expensegroup_id');
    }

    /**
     * expensegroup relationship to all scheduledExpenses.
     */
    public function scheduledExpenses()
    {
        return $this->hasMany(ScheduledExpense::class, 'expensegroup_id');
    }

    /**
     * expensegroup relationship to all expenseGroupUsers.
     */
    public function expenseGroupUsers()
    {
        return $this->hasMany(ExpenseGroupUser::class, 'expensegroup_id');
    }
}
