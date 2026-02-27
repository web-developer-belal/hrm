<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceSyncHistories extends Model
{
    protected $fillable = [
        'device_id',
        'total_logs',
        'sync_started_at',
        'sync_completed_at',
        'status',
        'message',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
