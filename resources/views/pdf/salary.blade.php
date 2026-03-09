<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Report - {{ $month }} {{ $year }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10px;
            font-size: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header h2 {
            margin: 5px 0;
            font-size: 14px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 11px;
        }
        .cutting-line {
            border-top: 1px dashed #000;
            margin: 8px 0;
            width: 100%;
        }
        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 11px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px 2px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 9px;
        }
        td {
            font-size: 8px;
        }
        .text-left {
            text-align: left;
            padding-left: 5px;
        }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding: 0 20px;
        }
        .signature-box {
            text-align: center;
            width: 30%;
        }
        .signature-line {
            margin-top: 40px;
            border-top: 1px solid #000;
            padding-top: 5px;
            font-size: 10px;
            font-weight: bold;
        }
        .signature-title {
            font-size: 9px;
            color: #555;
            margin-top: 3px;
        }
        .footer-note {
            text-align: right;
            font-size: 8px;
            margin-top: 10px;
            font-style: italic;
        }
        @media print {
            body {
                margin: 0.5cm;
            }
            .no-print {
                display: none;
            }
            th {
                background-color: #f0f0f0 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .signature-section{
                display: flex;
            }
        }
        .print-button {
            margin: 10px 0;
            text-align: right;
        }
        .print-button button {
            padding: 8px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        .print-button button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    @if(!isset($print))
    <div class="print-button no-print">
        <button onclick="window.print()">Print Report</button>
        @isset($payrollIds)
        <button onclick="window.location.href='{{ route('admin.payroll.salary.pdf', ['payrolls' => implode(',', $payrollIds)]) }}'">Download PDF</button>
        @endisset
    </div>
    @endif

    <div class="header">
        <h1>{{ $companyName }}</h1>
        <h2>Salary Report - {{ $branchName }}</h2>
        <h2>Month of {{ $month }} {{ $year }}</h2>
        <div class="cutting-line"></div>
        <div class="report-info">
            <span>Date: {{ $generatedDate }}</span>
            <span>Report Type: Monthly Salary Statement</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">SI</th>
                <th rowspan="2">Employee Code<br>Name<br>Designation</th>
                <th rowspan="2">Basic Salary</th>
                <th rowspan="2">House Rent</th>
                <th rowspan="2">Medical Allowance</th>
                <th rowspan="2">Gross Salary</th>
                <th rowspan="2">Total Days</th>
                <th rowspan="2">Present Days</th>
                <th colspan="3">Leave</th>
                <th rowspan="2">Absent</th>
                <th rowspan="2">Absent Deduction</th>
                <th rowspan="2">Total Deduction</th>
                <th colspan="3">Overtime</th>
                <th rowspan="2">Net Salary</th>
            </tr>
            <tr>
                <th>Off Day</th>
                <th>Holiday</th>
                <th>Leave</th>
                <th>Hours</th>
                <th>Rate</th>
                <th>Taka</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee['si'] }}</td>
                <td class="text-left">
                    <strong>{{ $employee['employee_code'] }}</strong><br>
                    {{ $employee['name'] }}<br>
                    <small>{{ $employee['designation'] }}</small>
                </td>
                <td>{{ number_format($employee['basic_salary'], 2) }}</td>
                <td>{{ number_format($employee['house_rent'], 2) }}</td>
                <td>{{ number_format($employee['medical_allowance'], 2) }}</td>
                <td>{{ number_format($employee['gross_salary'], 2) }}</td>
                <td>{{ $employee['total_days'] }}</td>
                <td>{{ $employee['present_days'] }}</td>
                <td>{{ $employee['off_days'] }}</td>
                <td>{{ $employee['holy_days'] }}</td>
                <td>{{ $employee['leave_days'] }}</td>
                <td>{{ $employee['absent_days'] }}</td>
                <td>{{ number_format($employee['absent_deduction'], 2) }}</td>
                <td>{{ number_format($employee['total_deduction'], 2) }}</td>
                <td>{{ $employee['overtime_hours'] }}</td>
                <td>{{ number_format($employee['overtime_rate'], 2) }}</td>
                <td>{{ number_format($employee['overtime_taka'], 2) }}</td>
                <td><strong>{{ number_format($employee['net_salary'], 2) }}</strong></td>
            </tr>
            @endforeach

            <!-- Summary Row -->
            <tr style="font-weight: bold; background-color: #e8e8e8;">
                <td colspan="2" class="text-left">Total</td>
                <td>{{ number_format(collect($employees)->sum('basic_salary'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('house_rent'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('medical_allowance'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('gross_salary'), 2) }}</td>
                <td>{{ collect($employees)->sum('total_days') }}</td>
                <td>{{ collect($employees)->sum('present_days') }}</td>
                <td>{{ collect($employees)->sum('off_days') }}</td>
                <td>{{ collect($employees)->sum('holy_days') }}</td>
                <td>{{ collect($employees)->sum('leave_days') }}</td>
                <td>{{ collect($employees)->sum('absent_days') }}</td>
                <td>{{ number_format(collect($employees)->sum('absent_deduction'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('total_deduction'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('overtime_hours'), 2) }}</td>
                <td>{{ number_format(collect($employees)->avg('overtime_rate'), 2) }}</td>
                <td>{{ number_format(collect($employees)->sum('overtime_taka'), 2) }}</td>
                <td><strong>{{ number_format(collect($employees)->sum('net_salary'), 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Prepared By</div>
           
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Paid By</div>
           
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Granted By</div>
            
        </div>
    </div>

    <div class="footer-note">
        This is a computer generated statement - no signature required.
    </div>

    @if(isset($print))
    <script>
        window.onload = function() {
            window.print();
        }
    </script>
    @endif
</body>
</html>
