<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendancePolicy extends Model
{
    //

   protected $fillable = [
        'branch_id',
        'policy_name',
        'description',
        'in_grace_period_minutes',
        'out_grace_period_minutes',
        'late_deduction_count_days',
        'status',
    ];

       public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
