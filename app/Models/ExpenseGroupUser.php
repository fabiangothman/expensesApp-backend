<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseGroupUser extends Model
{
    use HasFactory;

    protected $timestamps = true;
    protected $fillable = [
        'user_id',
        'expensegroup_id',
    ];


    /**
     * expenseGroupUser relationship to user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * expensegroup relationship to expenseGroup.
     */
    public function expenseGroup()
    {
        return $this->belongsTo(ExpenseGroup::class, 'expensegroup_id');
    }
}
