<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollAdjustment extends Model
{
    //

   protected $fillable = [
        'branch_id',
        'employee_id',
        'type',
        'amount',
        'note',
        'is_settled',
        'year',
        'month',
        'date',
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
