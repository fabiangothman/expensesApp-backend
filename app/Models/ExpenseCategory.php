<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'expensegroup_id',
        'description',
        'parentcategory_id',
    ];


    /**
     * expenseCategory relationship to expenseGroup.
     */
    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class, 'expensegroup_id');
    }
    
    /**
     * expenseCategory relationship to parentCategory.
     */
    public function parentCategory()
    {
        return $this->belongsTo(ExpenseCategory::class, 'parentcategory_id');
    }
    
    /**
     * expenseCategory relationship to all subCategories.
     */
    public function subCategories()
    {
        return $this->hasMany(ExpenseCategory::class, 'parentcategory_id');
    }
    
    /**
     * expenseCategory relationship to all expenses.
     */
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'expensecategory_id');
    }
}
