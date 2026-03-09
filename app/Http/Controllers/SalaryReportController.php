<?php
namespace App\Http\Controllers;

use App\Models\Payroll;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalaryReportController extends Controller
{
    public function index(Request $request)
    {
        $ids        = $this->extractPayrollIds($request);
        $reportData = $this->getReportData($ids);

        return view('pdf.salary', [
            'employees'     => $reportData['employees'],
            'branchName'    => $reportData['branchName'],
            'month'         => $reportData['month'],
            'year'          => $reportData['year'],
            'companyName'   => $reportData['companyName'],
            'preparedBy'    => $reportData['preparedBy'],
            'grantedBy'     => $reportData['grantedBy'],
            'generatedDate' => $reportData['generatedDate'],
            'payrollIds'   => $ids,
        ]);
    }

    public function generatePDF(Request $request)
    {
        $ids        = $this->extractPayrollIds($request);
        $reportData = $this->getReportData($ids);

        $pdf = Pdf::loadView('pdf.salary', $reportData);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('salary-report-' . $reportData['month'] . '-' . $reportData['year'] . '.pdf');
    }

    public function print(Request $request)
    {
        $ids        = $this->extractPayrollIds($request);
        $reportData = $this->getReportData($ids);
        return view('pdf.salary', $reportData);
    }

    private function extractPayrollIds(Request $request): array
    {
        $payrolls = $request->route('payrolls', $request->input('payrolls', ''));

        if (is_array($payrolls)) {
            return array_values(array_filter($payrolls, fn ($id) => $id !== null && $id !== ''));
        }

        return array_values(array_filter(explode(',', (string) $payrolls), fn ($id) => $id !== ''));
    }

    private function getReportData($ids)
    {
        $payrollRecords = Payroll::with(['employee.designation', 'employee.salaryData', 'branch'])->whereIn('id', $ids)->get();

        $branchName = $payrollRecords->isNotEmpty() ? $payrollRecords->first()->branch->name : 'All Branches';
        $month      = $payrollRecords->isNotEmpty() ? date('F', mktime(0, 0, 0, $payrollRecords->first()->month, 1)) : date('F');
        $year       = $payrollRecords->isNotEmpty() ? $payrollRecords->first()->year : date('Y');

        $employees = $payrollRecords->map(function ($payroll, $index) {
            return [
                'si'                => $index + 1,
                'employee_code'     => $payroll->employee->employee_code ?? 'N/A',
                'name'              => $payroll->employee->full_name ?? 'N/A',
                'designation'       => $payroll->employee->designation->name ?? 'N/A',
                'basic_salary'      => $payroll->basic_salary ?? 0,
                'house_rent'        => $payroll->employee->salaryData->house_rent ?? 0,
                'medical_allowance' => $payroll->employee->salaryData->medical_allowance ?? 0,
                'gross_salary'      => $payroll->gross_salary ?? 0,
                'total_days'        => $payroll->total_days ?? 0,
                'present_days'      => $payroll->present_days ?? 0,
                'off_days'          => $payroll->off_days ?? 0,
                'holy_days'         => $payroll->holy_days ?? 0,
                'leave_days'        => $payroll->leave_days ?? 0,
                'absent_days'       => $payroll->absent_days ?? 0,
                'absent_deduction'  => $payroll->absent_deduction ?? 0,
                'total_deduction'   => $payroll->total_deduction ?? 0,
                'overtime_hours'    => $payroll->total_ot ? round($payroll->total_ot / 60, 2) : 0,
                'overtime_rate'     => $payroll->employee->salaryData->overtime_rate ?? 0,
                'overtime_taka'     => $payroll->total_ot ?? 0,
                'net_salary'        => $payroll->net_salary ?? 0,
            ];
        })->toArray();
        return [
            'month'         => $month,
            'year'          => $year,
            'employees'     => $employees,
            'branchName'    => $branchName,
            'companyName'   => settingData('company_name') ?? 'Company Name',
            'preparedBy'    => Auth::user()->full_name,
            'grantedBy'     => 'Authorized Personnel',
            'generatedDate' => now()->format('d-m-Y'),
        ];
    }
}
