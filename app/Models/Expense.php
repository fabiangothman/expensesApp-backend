<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'date',
        'transaction_type',
        'value',
        'processed',
        'expensegroup_id',
        'expensecategory_id',
        'description',
    ];

    /**
     * expense relationship to expenseCategory.
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expensecategory_id');
    }

    /**
     * expense relationship to expenseGroup.
     */
    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class, 'expensegroup_id');
    }

    /**
     * expense relationship to transaction.
     */
    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'expense_id');
    }

    /**
     * expense relationship to scheduledExpense.
     */
    public function scheduledExpense()
    {
        return $this->hasOne(ScheduledExpense::class, 'expense_id');
    }
}
