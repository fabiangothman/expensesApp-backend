<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyBox extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'currency_code',
    ];
    
    
    /**
     * moneyBox relationship to all expenseGroups.
     */
    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class, 'moneybox_id');
    }
}
