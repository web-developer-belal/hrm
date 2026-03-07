<?php

namespace App\Exports\Employee;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeBankDetails implements FromCollection, WithHeadings
{
    protected $employees;
    protected $isMfs;

    public function __construct($employees, $isMfs = false)
    {
        $this->employees = $employees;
        $this->isMfs = $isMfs;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::with('branch', 'department', 'designation')
            ->when($this->employees, function ($query) {
                $query->whereIn('id', $this->employees);
            })
            ->get()
            ->map(function ($employee) {
                $baseData = [
                    'id' => $employee->id,
                    'emp_code' => $employee->employee_code,
                    'name' => $employee->full_name,
                    'designation' => $employee->designation ? $employee->designation->name : '',
                    'branch' => $employee->branch ? $employee->branch->name : '',
                    'department' => $employee->department ? $employee->department->name : '',
                ];

                if ($this->isMfs) {
                    return array_merge($baseData, [
                        'account_holder_name' => $employee->account_holder_name ?? '',
                        'mfs_account' => $employee->mfs_account ?? '',
                    ]);
                }

                return array_merge($baseData, [
                    'bank_name' => $employee->bank_name ?? '',
                    'account_holder_name' => $employee->account_holder_name ?? '',
                    'account_number' => $employee->account_number ?? '',
                    'bank_account_type' => $employee->bank_account_type ?? '',
                    'routing_number' => $employee->routing_number ?? '',
                    'bank_notes' => $employee->bank_notes ?? '',
                ]);
            });
    }

    public function headings(): array
    {
        $baseHeadings = [
            'SL',
            'Emp Code',
            'Name',
            'Designation',
            'Branch',
            'Department',
        ];

        if ($this->isMfs) {
            return array_merge($baseHeadings, [
                'Account Holder Name',
                'MFS Account Number',
            ]);
        }

        return array_merge($baseHeadings, [
            'Bank Name',
            'Account Holder Name',
            'Account Number',
            'Account Type',
            'Routing Number',
            'Bank Notes',
        ]);
    }
}
