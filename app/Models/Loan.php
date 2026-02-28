<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'employee_id',
        'amount',
        'installments',
        'emi_amount',
        'remaining_amount',
        'status',
        'start_month',
    ];

    protected $with = ['installments_data'];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function installments_data()
    {
        return $this->hasMany(LoanInstallment::class);
    }

}
