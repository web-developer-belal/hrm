<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    //

   protected $fillable = [
        'branch_id',
        'employee_id',
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'dear_allowance',
        'transport_allowance',
        'pf_employer_contribution',
        'other_allowance',
        'pf_employee_contribution',
        'welfare_contribution',
        'tax_deduction',

    ];
}
