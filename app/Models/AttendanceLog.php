<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable=[
        'device_id',
        'employee_id',
        'attendance_date',
        'attendance_time',
        'attendance_minute',
        'device_timestamp',
    ];
}
