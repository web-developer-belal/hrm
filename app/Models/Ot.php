<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    protected $fillable = [
        'name',
        'off_day_counting',
        'branch_group_id',
        'include_in_payroll',
    ];

    protected $casts = [
        'off_day_counting' => 'boolean',
        'include_in_payroll' => 'boolean',
    ];
    
    public function group()
    {
        return $this->belongsTo(BranchGroup::class);
    }

    public function rates()
    {
        return $this->hasMany(OtRate::class);
    }
}
