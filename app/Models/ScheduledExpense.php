<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledExpense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'transaction_type',
        'value',
        'frequency_type',
        'frequency',
        'start_date',
        'end_date',
        'active',
        'expensegroup_id',
        'expensecategory_id',
        'description',
    ];


    /**
     * scheduledExpense relationship to expenseGroup.
     */
    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class, 'expensegroup_id');
    }


    /**
     * scheduledExpense relationship to expenseCategory.
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expensecategory_id');
    }

    /**
     * scheduledExpense relationship to all transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'scheduledexpense_id');
    }
}
