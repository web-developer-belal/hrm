<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RosterEmployee extends Model
{
    protected $table = 'roster_employees';
    protected $fillable = [
        'roster_id',
        'employee_id',
    ];
    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
