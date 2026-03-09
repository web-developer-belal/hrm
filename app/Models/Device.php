<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name',
        'ip_address',
        'port',
        'status',
        'branch_id',
        'no_sn',
        'online',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
