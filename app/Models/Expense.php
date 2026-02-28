<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
   protected $fillable = [
        'branch_id',
        'expense_type_id',
        'name',
        'amount',
        'date',
    ];

    protected $casts = [
        'date'=>'date',
        'amount'=>'decimal:2'
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function type(){
        return $this->belongsTo(ExpenseType::class,'expense_type_id');
    }
}
