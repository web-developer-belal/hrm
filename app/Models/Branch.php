<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'contact',
        'address',
        'status',
        'branch_group_id'
    ];

    public function branchGroup()
    {
        return $this->belongsTo(BranchGroup::class);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function expenseTypes()
    {
        return $this->hasMany(ExpenseType::class);
    }

    public function notices()
    {
        return $this->hasMany(Notice::class);
    }

    public function payrolls()
    {
        return $this->hasMany(Payroll::class);
    }

    public function holidays()
    {
        return $this->hasMany(Holiday::class);
    }
}

