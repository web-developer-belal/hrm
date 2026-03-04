<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{

    protected $fillable = [
        'branch_id',
        'employee_id',
        'form_branch_id',
        'form_department_id',
        'form_designation_id',
        'to_branch_id',
        'to_department_id',
        'to_designation_id',
        'note',
        'status',
        'approved_by',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function fromBranch()
    {
        return $this->belongsTo(Branch::class, 'form_branch_id');
    }
    public function toBranch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    public function toDepartment()
    {
        return $this->belongsTo(Department::class, 'to_department_id');
    }
    public function fromDepartment()
    {
        return $this->belongsTo(Department::class, 'form_department_id');
    }
}
