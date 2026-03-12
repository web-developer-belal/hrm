<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{

    protected $fillable = [
        'branch_id',
        'employee_id',
        'period_start',
        'period_end',
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

    protected $casts = [
        'approved_at'  => 'datetime',
        'is_locked'    => 'boolean',
        'is_generated' => 'boolean',
        'per_day_salary' => 'decimal:2',
        'basic_salary' => 'decimal:2',
        'attendance_bonus' => 'decimal:2',
        'total_ot' => 'decimal:2',
        'late_deduction' => 'decimal:2',
        'loan_deduction' => 'decimal:2',
        'positive_adjustments' => 'decimal:2',
        'negative_adjustments' => 'decimal:2',
        'absent_deduction' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'period_start' => 'date',
        'period_end' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

}
