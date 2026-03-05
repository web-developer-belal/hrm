<?php

namespace App\Exports\Employee;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeList implements FromCollection , WithHeadings
{
    protected $selectedIds;

    public function __construct($selectedIds = [])
    {
        $this->selectedIds = $selectedIds;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::with('branch', 'department', 'designation')
            ->when(!empty($this->selectedIds), function ($query) {
                $query->whereIn('id', $this->selectedIds);
            })
            ->get()
            ->map(function ($employee) {
                return [
                    'id' => $employee->id,
                    'emp_code' => $employee->employee_code,
                    'name' => $employee->full_name,
                    'email' => $employee->email,
                    'phone' => $employee->contact_number,
                    'designation' => $employee->designation ? $employee->designation->name : '',
                    'address' => $employee->permanent_address ?? $employee->local_address ?? '',
                    'branch' => $employee->branch ? $employee->branch->name : '',
                    'department' => $employee->department ? $employee->department->name : '',
                    'joining_date' => $employee->joining_date ? $employee->joining_date->format('Y-m-d') : '',
                    'status' => $employee->status ? 'Active' : 'Inactive',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'SL',
            'Emp Code',
            'Name',
            'Email',
            'Phone',
            'Designation',
            'Address',
            'Branch',
            'Department',
            'Joining Date',
            'Status',
        ];
    }
}
    