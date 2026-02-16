<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanInstallment extends Model
{
    //

    protected $fillable = [
        'loan_id',
        'year',
        'month',
        'amount',
        'is_paid'
    ];
}
