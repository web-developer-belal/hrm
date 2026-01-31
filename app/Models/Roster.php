<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    protected $fillable = [
        'name',
        'branch_id',
        'department_id',
        'shift_id',
        'start_date',
        'end_date',
        'working_days',
        'weekly_off_days',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
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

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
