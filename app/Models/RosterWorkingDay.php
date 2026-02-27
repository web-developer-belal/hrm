<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RosterWorkingDay extends Model
{
    use HasFactory;
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
