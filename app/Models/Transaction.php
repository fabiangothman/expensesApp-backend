<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'canceled',
        'expense_id',
        'description',
    ];

    /**
     * transaction relationship to expense.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class, 'expense_id');
    }
}
