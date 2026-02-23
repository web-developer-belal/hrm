<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'branch_id',
        'department_id',
        'shift_id',
        'start_date',
        'end_date',
        'status',
        'working_days',
        'weekly_off_days',

    ];

    protected $casts = [
        'working_days' => 'array',
        'weekly_off_days' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // public function employees()
    // {
    //     return $this->belongsToMany(RosterEmployee::class);
    // }

    public function workingDays()
    {
        return $this->hasMany(RosterWorkingDay::class)->where('type', 'working');
    }

    public function weeklyOffDays()
    {
        return $this->hasMany(RosterWorkingDay::class)->where('type', 'off');
    }

    // public function rosterEmployees()
    // {
    //     return $this->hasMany(RosterEmployee::class);
    // }

    // public function employees()
    // {
    //     return $this->hasManyThrough(
    //         Employee::class,
    //         RosterEmployee::class,
    //         'roster_id',     // Foreign key on roster_employees table
    //         'id',            // Foreign key on employees table
    //         'id',            // Local key on rosters table
    //         'employee_id'    // Local key on roster_employees table
    //     );
    // }


    public function rosterEntries()
    {
        return $this->hasMany(RosterEmployee::class);
    }

      public function employees()
    {
        return $this->belongsToMany(Employee::class, 'roster_employees')
            ->withPivot(['date', 'is_off_day', 'shift_id', 'notes'])
            ->withTimestamps();
    }
}
