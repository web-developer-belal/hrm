<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{


    protected $fillable = [
        'branch_id',
        'employee_id',
        'amount',
        'installments',
        'emi_amount',
        'remaining_amount',
        'status',
        'start_month'
    ];

    protected $with=['installments'];


    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }


    public function installments()
    {
        return $this->hasMany(LoanInstallment::class);
    }


}
