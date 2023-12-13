<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledExpense extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'frequency_type',
        'frequency',
        'start_date',
        'end_date',
        'expense_id',
        'active',
        'description',
    ];


    /**
     * scheduledExpense relationship to expense.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
