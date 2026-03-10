<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ot extends Model
{
    protected $fillable = [
        'name',
        'rate_type',
        'rate',
        'off_day_counting',
        'branch_group_id'
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'off_day_counting' => 'boolean',
    ];
    
    public function group()
    {
        return $this->belongsTo(BranchGroup::class);
    }
}
