<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RosterWorkingDay extends Model
{
    protected $fillable = [
        'roster_id',
        'type',
        'day',
    ];

    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }

}
