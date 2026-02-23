<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
use HasFactory;

 protected $fillable = [
        'branch_id',
        'employee_id',
        'roster_id',
        'date',
        'shift_start_time',
        'shift_end_time',
        'clock_in',
        'clock_out',
        'late_minutes',
        'status',
        'remarks',
        'is_manually_edited',
        'edited_by',
        'edited_at',
        'early_exit_minutes',
        'overtime_minutes',


    ];


    protected $casts = [
        'date' => 'date',
        'clock_in' => 'datetime',
        'clock_out' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }

       public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
