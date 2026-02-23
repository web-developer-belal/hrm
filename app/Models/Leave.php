<?php
namespace App\Models;

use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'employee_id',
        'leave_type_id',
        'from_date',
        'to_date',
        'total_days',
        'descriptions',
        'status',
        'confirmed_by',
        'approved_by',
    ];

    protected $casts = [
        'from_date' => 'date',
        'to_date'   => 'date',
    ];

    public function type()
    {
        return $this->belongsTo(LeaveType::class, 'leave_type_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
