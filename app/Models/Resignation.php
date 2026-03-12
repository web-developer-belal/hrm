<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resignation extends Model
{
   protected $fillable = [
        'employee_id',
        'subject',
        'resignation_date',
        'reason',
        'comment',
        'approver_by',
        'status',
    ];

    protected $casts = [
        'resignation_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_by');
    }

    
}
