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
        <button onclick="window.location.href='{{ route('salary.pdf') }}'">Download PDF</button>
    </div>
    @endif

    <div class="header">
        <h1>{{ $companyName }}</h1>
        <h2>Salary Report for the Month of {{ $month }} {{ $year }}</h2>
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
                <th rowspan="2">Card No</th>
                <th rowspan="2">Name</th>
                <th rowspan="2">Designation</th>
                <th rowspan="2">Current Total Salary</th>
                <th rowspan="2">Main Salary</th>
                <th rowspan="2">House Rent</th>
                <th rowspan="2">Food</th>
                <th rowspan="2">Transport</th>
                <th rowspan="2">Total Days</th>
                <th rowspan="2">Total Working Days</th>
                <th colspan="5">Leave</th>
                <th rowspan="2">Absent Days</th>
                <th rowspan="2">Total Absent Deduction</th>
                <th rowspan="2">Attendance Salary</th>
                <th rowspan="2">Total Salary & Bonus</th>
                <th colspan="3">Overtime</th>
                <th rowspan="2">Total Salary</th>
            </tr>
            <tr>
                <th>Weekly</th>
                <th>Festival</th>
                <th>Casual</th>
                <th>Sick</th>
                <th>Others</th>
                <th>Hours</th>
                <th>Rate</th>
                <th>Taka</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee['si'] }}</td>
                <td>{{ $employee['card_no'] }}</td>
                <td class="text-left">{{ $employee['name'] }}</td>
                <td class="text-left">{{ $employee['designation'] }}</td>
                <td>{{ number_format($employee['current_total_salary']) }}</td>
                <td>{{ number_format($employee['main_salary']) }}</td>
                <td>{{ number_format($employee['house_rent']) }}</td>
                <td>{{ number_format($employee['food']) }}</td>
                <td>{{ number_format($employee['transport']) }}</td>
                <td>{{ $employee['total_days'] }}</td>
                <td>{{ $employee['total_working_days'] }}</td>
                <td>{{ $employee['weekly_leave'] }}</td>
                <td>{{ $employee['festival_leave'] }}</td>
                <td>{{ $employee['casual_leave'] }}</td>
                <td>{{ $employee['sick_leave'] }}</td>
                <td>{{ $employee['others_leave'] }}</td>
                <td>{{ $employee['absent_days'] }}</td>
                <td>{{ number_format($employee['total_absent_deduction']) }}</td>
                <td>{{ number_format($employee['attendance_salary']) }}</td>
                <td>{{ number_format($employee['total_salary_bonus']) }}</td>
                <td>{{ $employee['overtime_hours'] }}</td>
                <td>{{ number_format($employee['overtime_rate']) }}</td>
                <td>{{ number_format($employee['overtime_taka']) }}</td>
                <td><strong>{{ number_format($employee['total_salary']) }}</strong></td>
            </tr>
            @endforeach

            <!-- Summary Row -->
            <tr style="font-weight: bold; background-color: #e8e8e8;">
                <td colspan="4" class="text-left">Total</td>
                <td>{{ number_format(collect($employees)->sum('current_total_salary')) }}</td>
                <td>{{ number_format(collect($employees)->sum('main_salary')) }}</td>
                <td>{{ number_format(collect($employees)->sum('house_rent')) }}</td>
                <td>{{ number_format(collect($employees)->sum('food')) }}</td>
                <td>{{ number_format(collect($employees)->sum('transport')) }}</td>
                <td>{{ collect($employees)->sum('total_days') }}</td>
                <td>{{ collect($employees)->sum('total_working_days') }}</td>
                <td>{{ collect($employees)->sum('weekly_leave') }}</td>
                <td>{{ collect($employees)->sum('festival_leave') }}</td>
                <td>{{ collect($employees)->sum('casual_leave') }}</td>
                <td>{{ collect($employees)->sum('sick_leave') }}</td>
                <td>{{ collect($employees)->sum('others_leave') }}</td>
                <td>{{ collect($employees)->sum('absent_days') }}</td>
                <td>{{ number_format(collect($employees)->sum('total_absent_deduction')) }}</td>
                <td>{{ number_format(collect($employees)->sum('attendance_salary')) }}</td>
                <td>{{ number_format(collect($employees)->sum('total_salary_bonus')) }}</td>
                <td>{{ collect($employees)->sum('overtime_hours') }}</td>
                <td>{{ number_format(collect($employees)->avg('overtime_rate')) }}</td>
                <td>{{ number_format(collect($employees)->sum('overtime_taka')) }}</td>
                <td><strong>{{ number_format(collect($employees)->sum('total_salary')) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Prepared By</div>
            <div>{{ $preparedBy }}</div>
            <div style="font-size: 8px;">Department of IT</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Granted By</div>
            <div>{{ $grantedBy }}</div>
            <div style="font-size: 8px;">Department of Account</div>
        </div>
        <div class="signature-box">
            <div class="signature-line"></div>
            <div class="signature-title">Granted By</div>
            <div>{{ $grantedBy }}</div>
            <div style="font-size: 8px;">Authorized Signature</div>
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
