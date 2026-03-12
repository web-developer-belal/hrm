<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollRule extends Model
{
    protected $fillable = [
        'name',
        'type',
        'calc_type',
        'value',
        'condition_type',
        'condition_present_days',
        'condition_from',
        'condition_to',
        'branch_group_id',
        'is_active',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function branchGroup()
    {
        return $this->belongsTo(BranchGroup::class);
    }
}
