<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'address',
        'status',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function rosters()
    {
        return $this->hasMany(Roster::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}

