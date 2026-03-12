<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendancePolicy extends Model
{
    
    protected $fillable = [
        'branch_id',
        'policy_name',
        'description',
        'in_grace_period_minutes',
        'out_grace_period_minutes',
        'late_deduction_count_days',
        'late_cutoff_time',
        'mark_absent_if_late',
        'late_penalty_threshold_days',
        'late_penalty_deduct_days',
        'continuous_absent_months_for_suspend',
        'auto_suspend_on_continuous_absence',
        'status',
    ];

    protected $casts = [
        'in_grace_period_minutes'              => 'integer',
        'out_grace_period_minutes'             => 'integer',
        'late_deduction_count_days'            => 'integer',
        'late_cutoff_time'                     => 'string',
        'mark_absent_if_late'                  => 'boolean',
        'late_penalty_threshold_days'          => 'integer',
        'late_penalty_deduct_days'             => 'decimal:2',
        'continuous_absent_months_for_suspend' => 'integer',
        'auto_suspend_on_continuous_absence'   => 'boolean',
        'status'                               => 'string',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
