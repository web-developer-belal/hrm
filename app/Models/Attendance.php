<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{


   protected $fillable = [
        'branch_id',
        'employee_id','roster_id','date',
        'shift_start_time','shift_end_time',
        'clock_in','clock_out',
        'late_minutes','early_exit_minutes','status'
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
}
