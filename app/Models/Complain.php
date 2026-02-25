<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
      protected $fillable = [
        'branch_id',
        'employee_id',
        'against_employee_id',
        'subject',
        'date',
        'document',
        'description',
        'status',
        'remarks',
    ];

    protected $with=['complainant','againstEmp','branch'];

    protected $casts = [
        'date' => 'date',
    ];

    public function complainant()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function againstEmp()
    {
        return $this->belongsTo(Employee::class,'against_employee_id');
    }

       public function branch()
    {
        return $this->belongsTo(Branch::class);
    }


    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            0 => 'Pending',
            1 => 'Resolved',
            2 => 'Rejected',
            default => 'Unknown',
        };
    }


}
