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
        'expense_group_id',
        'expense_group_category_id',
        'description',
    ];


    /**
     * expense relationship to expenseGroup.
     */
    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class, 'expensegroup_id');
    }

    /**
     * expense relationship to expenseCategory.
     */
    public function expenseCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expensecategory_id');
    }

    /**
     * expense relationship to all transactions.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'expense_id');
    }
}
