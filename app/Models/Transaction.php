<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $timestamps = true;
    protected $fillable = [
        'scheduled_expenses_id',
        'expenses_id',
        'canceled',
    ];


    /**
     * transaction relationship to scheduledExpense.
     */
    public function scheduledExpense()
    {
        return $this->belongsTo(ScheduledExpense::class, 'scheduledexpense_id');
    }

    /**
     * transaction relationship to expense.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
