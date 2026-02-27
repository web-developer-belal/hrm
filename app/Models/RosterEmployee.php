<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RosterEmployee extends Model
{
    use HasFactory;
    
    protected $table    = 'roster_employees';

    protected $fillable = [
        'roster_id',
        'employee_id',
        'date',
        'is_off_day',
        'shift_id',
        'notes',
    ];
    protected $casts = [
        'date'       => 'date',
        'is_off_day' => 'boolean',
    ];
    public function roster()
    {
        return $this->belongsTo(Roster::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}
