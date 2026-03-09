<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $payroll->employee->gender=='male'?'Mr. ':($payroll->employee->gender=='female'?'Ms. ':'').$payroll->employee->first_name }} Payslip</title>
</head>
<body style="margin: 10px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f3f4f6; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="650" cellpadding="0" cellspacing="0" border="0" style="max-width: 950px; width: 100%; background-color: #ffffff; border-radius: 16px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">

                    <!-- Header with Company Info -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); padding: 35px 30px; border-radius: 16px 16px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <div style="background-color: rgba(255, 255, 255, 0.15); width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center;">
                                            <span style="color: #ffffff; font-size: 32px; font-weight: 700;">{{ settingData('company_name') }}</span>
                                        </div>
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 600; margin: 0 0 5px;">{{ settingData('company_name') }}</h1>
                                        <p style="color: #e0e7ff; font-size: 14px; margin: 0;">Payslip for the month of {{ \Carbon\Carbon::create()->month((int)$payroll->month)->format('F') }} {{ \Carbon\Carbon::create()->year((int)$payroll->year)->format('Y') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Employee Information Section -->
                    <tr>
                        <td style="padding: 35px 30px 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 20px;">
                                        <h2 style="color: #111827; font-size: 20px; font-weight: 600; margin: 0 0 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px;">
                                            Employee Details
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f9fafb; border-radius: 12px; padding: 20px;">
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Employee Name:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px; font-weight: 600;">{{ $payroll->employee->full_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Employee ID:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px;">{{ $payroll->employee->employee_code }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Department:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px;">{{ $payroll->employee->department->name ?? '' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Designation:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px;">{{ $payroll->employee->designation->name ?? '' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Pay Period:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px;">{{ $payroll->pay_period ?? '01 Mar 2026 - 31 Mar 2026' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Pay Month:</span>
                                                </td>
                                                <td width="50%" style="padding: 8px 0;">
                                                    <span style="color: #111827; font-size: 16px;">{{ \Carbon\Carbon::createFromDate($payroll->year, $payroll->month)->format('F Y') }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Earnings Section -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 15px;">
                                        <h3 style="color: #059669; font-size: 18px; font-weight: 600; margin: 0;">Earnings</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                                            <tr style="background-color: #f0fdf4; border-bottom: 2px solid #059669;">
                                                <td style="padding: 12px 15px; color: #065f46; font-weight: 600; font-size: 15px;">Description</td>
                                                <td style="padding: 12px 15px; color: #065f46; font-weight: 600; font-size: 15px; text-align: right;">Amount (৳)</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                                <td style="padding: 12px 15px; color: #374151;">Basic Salary</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->basic_salary ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb; background-color: #f9fafb;">
                                                <td style="padding: 12px 15px; color: #374151;">Attendance Bonus</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->attendance_bonus ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                                <td style="padding: 12px 15px; color: #374151;">Overtime Pay</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->total_ot ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb; background-color: #f9fafb;">
                                                <td style="padding: 12px 15px; color: #374151;">Positive Adjustments</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->positive_adjustments ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="background-color: #f0fdf4;">
                                                <td style="padding: 15px; color: #065f46; font-weight: 700; font-size: 16px;">Total Earnings</td>
                                                <td style="padding: 15px; color: #065f46; font-weight: 700; font-size: 18px; text-align: right;">{{ number_format($payroll->gross_salary ?? 0, 2) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Deductions Section -->
                    <tr>
                        <td style="padding: 20px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding-bottom: 15px;">
                                        <h3 style="color: #b91c1c; font-size: 18px; font-weight: 600; margin: 0;">Deductions</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                                            <tr style="background-color: #fef2f2; border-bottom: 2px solid #b91c1c;">
                                                <td style="padding: 12px 15px; color: #991b1b; font-weight: 600; font-size: 15px;">Description</td>
                                                <td style="padding: 12px 15px; color: #991b1b; font-weight: 600; font-size: 15px; text-align: right;">Amount (৳)</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                                <td style="padding: 12px 15px; color: #374151;">Late Deduction</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->late_deduction ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb; background-color: #f9fafb;">
                                                <td style="padding: 12px 15px; color: #374151;">Loan Deduction</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->loan_deduction ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                                <td style="padding: 12px 15px; color: #374151;">Absent Deduction</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->absent_deduction ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="border-bottom: 1px solid #e5e7eb; background-color: #f9fafb;">
                                                <td style="padding: 12px 15px; color: #374151;">Negative Adjustments</td>
                                                <td style="padding: 12px 15px; color: #374151; text-align: right;">{{ number_format($payroll->negative_adjustments ?? 0, 2) }}</td>
                                            </tr>
                                            <tr style="background-color: #fef2f2;">
                                                <td style="padding: 15px; color: #991b1b; font-weight: 700; font-size: 16px;">Total Deductions</td>
                                                <td style="padding: 15px; color: #991b1b; font-weight: 700; font-size: 18px; text-align: right;">{{ number_format($payroll->total_deduction ?? 0, 2) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Net Pay Section -->
                    <tr>
                        <td style="padding: 25px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); border-radius: 12px;">
                                <tr>
                                    <td style="padding: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td width="60%">
                                                    <p style="color: #e0e7ff; font-size: 16px; margin: 0 0 5px;">Net Payable Amount</p>
                                                    <p style="color: #ffffff; font-size: 32px; font-weight: 700; margin: 0;">৳{{ number_format($payroll->net_salary ?? 0, 2) }}</p>
                                                </td>
                                                <td width="40%" align="right">
                                                    <p style="color: #e0e7ff; font-size: 14px; margin: 0;">Payment Month</p>
                                                    <p style="color: #ffffff; font-size: 18px; font-weight: 600; margin: 0;">{{ date('F Y', mktime(0, 0, 0, $payroll->month ?? date('m'), 1, $payroll->year ?? date('Y'))) }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Payment Details & Bank Info -->
                    {{-- <tr>
                        <td style="padding: 20px 30px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f9fafb; border-radius: 12px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="padding-bottom: 12px;">
                                                    <h4 style="color: #374151; font-size: 16px; font-weight: 600; margin: 0 0 10px;">Payment Method</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Bank Name:</span>
                                                    <span style="color: #111827; font-size: 14px; font-weight: 500; margin-left: 10px;">{{ $bankName ?? 'First National Bank' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Account Number:</span>
                                                    <span style="color: #111827; font-size: 14px; font-weight: 500; margin-left: 10px;">**** **** **** {{ $lastFourDigits ?? '1234' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">
                                                    <span style="color: #6b7280; font-size: 14px;">Account Type:</span>
                                                    <span style="color: #111827; font-size: 14px; font-weight: 500; margin-left: 10px;">{{ $accountType ?? 'Savings' }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 15px 0 0;">
                                                    <span style="color: #6b7280; font-size: 13px;">Transaction Reference:</span>
                                                    <span style="color: #374151; font-size: 13px; font-family: monospace; margin-left: 10px;">{{ $transactionRef ?? 'TXN' . date('Ymd') . '001' }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> --}}

                    <!-- Year to Date Summary -->
                    <tr>
                        <td style="padding: 0 30px 25px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding: 15px; background-color: #f3f4f6; border-radius: 8px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td align="center">
                                                    <p style="color: #4b5563; font-size: 14px; margin: 0;">
                                                        <span style="font-weight: 600;">Attendance Summary:</span>
                                                        Present: {{ $payroll->present_days ?? 0 }} days |
                                                        Absent: {{ $payroll->absent_days ?? 0 }} days |
                                                        Leave: {{ $payroll->leave_days ?? 0 }} days |
                                                        Late: {{ $payroll->late_days ?? 0 }} days
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Notes and Footer -->
                    <tr>
                        <td style="padding: 0 30px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td style="padding: 15px; background-color: #fff3cd; border-radius: 8px; border-left: 4px solid #ffc107;">
                                        <p style="color: #856404; font-size: 13px; margin: 0;">
                                            <strong>Note:</strong> This is a system-generated payslip. For any discrepancies, please contact the HR department within 7 days.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px; border-radius: 0 0 16px 16px; border-top: 1px solid #e5e7eb;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 15px;">
                                        <p style="color: #64748b; font-size: 14px; margin: 0 0 10px;">
                                            <span style="font-weight: 600;">{{ settingData('company_name') }}</span> | HR Management System
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #2563eb; font-size: 13px; text-decoration: none;">Download PDF</a>
                                                </td>
                                                <td style="color: #cbd5e1;">|</td>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #2563eb; font-size: 13px; text-decoration: none;">View Portal</a>
                                                </td>
                                                <td style="color: #cbd5e1;">|</td>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #2563eb; font-size: 13px; text-decoration: none;">Contact HR</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 20px;">
                                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                            &copy; {{ date('Y') }} {{ settingData('company_name') }}. All rights reserved.<br>
                                            {{ settingData('company_address') }}<br>
                                            <span style="color: #2563eb;">{{ settingData('email_address') }}</span> | Tel: {{ settingData('phone_number') }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 15px;">
                                        <p style="color: #9ca3af; font-size: 11px; margin: 0;">
                                            This is a confidential document. If you are not the intended recipient, please delete it immediately.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
