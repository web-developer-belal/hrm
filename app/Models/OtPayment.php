<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtPayment extends Model
{
    //

   protected $fillable = [
        'branch_id',
        'employee_id',
        'year',
        'month',
        'overtime_minutes',
        'amount',
        'hours',
        'date',
        'is_paid',
    ];

    protected $casts = [
        'amount'           => 'decimal:2',
        'hours'            => 'integer',
        'overtime_minutes' => 'integer',
        'year'             => 'integer',
        'month'            => 'integer',
        'is_paid'          => 'boolean',
        'date'             => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
