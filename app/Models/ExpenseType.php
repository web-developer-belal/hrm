<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
   protected $fillable = [
        'branch_id',
        'name',
    ];

    public function branch(){
        return $this->belongsTo(Branch::class);
    }
    public function expenses(){
        return $this->hasMany(Expense::class);
    }
}
