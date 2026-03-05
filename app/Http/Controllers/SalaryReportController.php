<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SalaryReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', 'October');
        $year = $request->get('year', '2025');

        // Sample employee data
        $employees = $this->getSampleEmployees();

        $reportData = [
            'month' => $month,
            'year' => $year,
            'employees' => $employees,
            'companyName' => 'Your Company Name',
            'preparedBy' => 'John Doe',
            'grantedBy' => 'Jane Smith',
            'generatedDate' => now()->format('d-m-Y')
        ];

        return view('pdf.salary', $reportData);
    }

    public function generatePDF(Request $request)
    {
        $month = $request->get('month', 'October');
        $year = $request->get('year', '2025');

        $employees = $this->getSampleEmployees();

        $reportData = [
            'month' => $month,
            'year' => $year,
            'employees' => $employees,
            'companyName' => 'Your Company Name',
            'preparedBy' => 'John Doe',
            'grantedBy' => 'Jane Smith',
            'generatedDate' => now()->format('d-m-Y')
        ];

        $pdf = Pdf::loadView('pdf.salary', $reportData);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('salary-report-'.$month.'-'.$year.'.pdf');
    }

    public function print(Request $request)
    {
        $month = $request->get('month', 'October');
        $year = $request->get('year', '2025');

        $employees = $this->getSampleEmployees();

        $reportData = [
            'month' => $month,
            'year' => $year,
            'employees' => $employees,
            'companyName' => 'Your Company Name',
            'preparedBy' => 'John Doe',
            'grantedBy' => 'Jane Smith',
            'generatedDate' => now()->format('d-m-Y'),
            'print' => true
        ];

        return view('pdf.salary', $reportData);
    }

    private function getSampleEmployees()
    {
        return [
            [
                'si' => 1,
                'card_no' => 'EMP001',
                'name' => 'John Smith',
                'designation' => 'Senior Developer',
                'current_total_salary' => 50000,
                'main_salary' => 35000,
                'house_rent' => 10000,
                'food' => 3000,
                'transport' => 2000,
                'total_days' => 30,
                'total_working_days' => 26,
                'weekly_leave' => 2,
                'festival_leave' => 1,
                'casual_leave' => 1,
                'sick_leave' => 0,
                'others_leave' => 0,
                'absent_days' => 0,
                'total_absent_deduction' => 0,
                'attendance_salary' => 50000,
                'total_salary_bonus' => 50000,
                'overtime_hours' => 10,
                'overtime_rate' => 300,
                'overtime_taka' => 3000,
                'total_salary' => 53000
            ],
            [
                'si' => 2,
                'card_no' => 'EMP002',
                'name' => 'Sarah Johnson',
                'designation' => 'HR Manager',
                'current_total_salary' => 45000,
                'main_salary' => 32000,
                'house_rent' => 8000,
                'food' => 3000,
                'transport' => 2000,
                'total_days' => 30,
                'total_working_days' => 25,
                'weekly_leave' => 2,
                'festival_leave' => 1,
                'casual_leave' => 1,
                'sick_leave' => 1,
                'others_leave' => 0,
                'absent_days' => 1,
                'total_absent_deduction' => 1500,
                'attendance_salary' => 43500,
                'total_salary_bonus' => 43500,
                'overtime_hours' => 5,
                'overtime_rate' => 280,
                'overtime_taka' => 1400,
                'total_salary' => 44900
            ],
            [
                'si' => 3,
                'card_no' => 'EMP003',
                'name' => 'Michael Brown',
                'designation' => 'Accountant',
                'current_total_salary' => 40000,
                'main_salary' => 28000,
                'house_rent' => 7000,
                'food' => 3000,
                'transport' => 2000,
                'total_days' => 30,
                'total_working_days' => 24,
                'weekly_leave' => 2,
                'festival_leave' => 1,
                'casual_leave' => 0,
                'sick_leave' => 2,
                'others_leave' => 1,
                'absent_days' => 2,
                'total_absent_deduction' => 3000,
                'attendance_salary' => 37000,
                'total_salary_bonus' => 37000,
                'overtime_hours' => 0,
                'overtime_rate' => 0,
                'overtime_taka' => 0,
                'total_salary' => 37000
            ],
        ];
    }
}
