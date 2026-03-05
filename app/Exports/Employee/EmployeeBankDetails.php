<?php

namespace App\Exports\Employee;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeBankDetails implements FromCollection, WithHeadings
{
    protected $branchId;

    public function __construct($branchId = null)
    {
        $this->branchId = $branchId;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::with('branch', 'department', 'designation')
            ->when($this->branchId, function ($query) {
                $query->where('branch_id', $this->branchId);
            })
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'emp_code' => $employee->employee_code,
                    'name' => $employee->full_name,
                    'designation' => $employee->designation ? $employee->designation->name : '',
                    'branch' => $employee->branch ? $employee->branch->name : '',
                    'department' => $employee->department ? $employee->department->name : '',
                    'bank_name' => $employee->bank_name ?? '',
                    'account_holder_name' => $employee->account_holder_name ?? '',
                    'account_number' => $employee->account_number ?? '',
                    'bank_account_type' => $employee->bank_account_type ?? '',
                    'routing_number' => $employee->routing_number ?? '',
                    'bank_notes' => $employee->bank_notes ?? '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'SL',
            'Emp Code',
            'Name',
            'Designation',
            'Branch',
            'Department',
            'Bank Name',
            'Account Holder Name',
            'Account Number',
            'Account Type',
            'Routing Number',
            'Bank Notes',
        ];
    }
}
