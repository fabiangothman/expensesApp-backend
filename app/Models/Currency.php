<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'iso_code',
        'description',
    ];
    
    
    /**
     * currency relationship to all expenseGroups.
     */
    public function expenseGroups()
    {
        return $this->hasMany(ExpenseGroup::class, 'currency_id');
    }
}
