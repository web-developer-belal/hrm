<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{


   protected $fillable = [
        'branch_id',
        'employee_id',
        'year',
        'month',
        'total_days',
        'total_working_days',
        'present_days',
        'off_days',
        'holy_days',
        'leave_days',
        'absent_days',
        'late_days',
        'late_penalty_days',
        'per_day_salary',
        'basic_salary',
        'attendance_bonus',
        'total_ot',
        'late_deduction',
        'loan_deduction',
        'positive_adjustments',
        'negative_adjustments',
        'absent_deduction',
        'total_deduction',
        'gross_salary',
        'net_salary',
        'is_locked',
        'status',
        'approved_by',
        'approved_at',
        'is_generated',
        'approval_stage',
    ];



    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
