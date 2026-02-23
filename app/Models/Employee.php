<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'photo',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'alternative_phone_number',
        'local_address',
        'permanent_address',
        'description',
        'employee_code',
        'branch_id',
        'department_id',
        'designation_id',
        'shift_id',
        'joining_date',
        'workspace',
        'supervisor_id',
        'bank_name',
        'routing_number',
        'account_holder_name',
        'bank_account_type',
        'account_number',
        'bank_notes',
        'status',
        'resume',
        'offer_letter',
        'joining_letter',
        'contract_agreement',
        'Id_proof',
        'email',
        'password',

    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date'  => 'date',
    ];

    /* =====================
     | Relationships
     ===================== */

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    
    public function salaryData()
    {
        return $this->hasOne(Salary::class);
    }

    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }
    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }

    // Supervisor (Manager)
    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    // Employees under this supervisor
    public function subordinates()
    {
        return $this->hasMany(Employee::class, 'supervisor_id');
    }


    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function rosters()
    {
        return $this->belongsToMany(Roster::class, 'roster_employee');
    }

}
