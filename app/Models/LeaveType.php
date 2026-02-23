<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

   protected $fillable = [
        'branch_id',
        'name',
        'annual_limit',
        'is_paid',
    ];


     public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
