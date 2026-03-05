<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthly Attendance Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="margin: 10px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f7fa; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 900px; width: 100%; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #7c3aed 0%, #5b21b6 100%); padding: 40px 30px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <img src="{{ asset('images/logo-white.png') }}" alt="{{ $companyName ?? 'Company Logo' }}" style="width: 60px; height: auto; margin-bottom: 15px;" onerror="this.style.display='none'">
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 600; margin: 10px 0 5px; line-height: 1.3;">Monthly Attendance Report</h1>
                                        <p style="color: #ddd6fe; font-size: 16px; margin: 0;">{{ $month ?? 'March' }} {{ $year ?? '2026' }} Attendance Summary</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Main Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <!-- Greeting -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #374151; font-size: 18px; font-weight: 500; margin: 0;">Dear {{ $employeeName ?? 'Employee' }},</p>
                                    </td>
                                </tr>

                                <!-- Message -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #4b5563; font-size: 16px; line-height: 1.6; margin: 0;">
                                            Please find below your monthly attendance summary for <span style="color: #7c3aed; font-weight: 600;">{{ $month ?? 'March' }} {{ $year ?? '2026' }}</span>.
                                            This report includes your daily attendance records, check-in/out times, and any exceptions.
                                        </p>
                                    </td>
                                </tr>

                                <!-- Attendance Summary Cards -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <!-- Present Days Card -->
                                                <td width="33.33%" style="padding-right: 10px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ecfdf5; border-radius: 8px; border: 1px solid #a7f3d0;">
                                                        <tr>
                                                            <td align="center" style="padding: 15px 10px;">
                                                                <span style="font-size: 28px; color: #059669;">✅</span>
                                                                <p style="color: #065f46; font-size: 20px; font-weight: 700; margin: 5px 0 0 0;">{{ $presentDays ?? 22 }}</p>
                                                                <p style="color: #047857; font-size: 13px; font-weight: 500; margin: 0;">Present Days</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Absent Days Card -->
                                                <td width="33.33%" style="padding: 0 5px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fef2f2; border-radius: 8px; border: 1px solid #fecaca;">
                                                        <tr>
                                                            <td align="center" style="padding: 15px 10px;">
                                                                <span style="font-size: 28px; color: #dc2626;">❌</span>
                                                                <p style="color: #991b1b; font-size: 20px; font-weight: 700; margin: 5px 0 0 0;">{{ $absentDays ?? 2 }}</p>
                                                                <p style="color: #b91c1c; font-size: 13px; font-weight: 500; margin: 0;">Absent Days</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <!-- Total Working Days -->
                                                <td width="33.33%" style="padding-left: 10px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-radius: 8px; border: 1px solid #bfdbfe;">
                                                        <tr>
                                                            <td align="center" style="padding: 15px 10px;">
                                                                <span style="font-size: 28px; color: #2563eb;">📅</span>
                                                                <p style="color: #1e40af; font-size: 20px; font-weight: 700; margin: 5px 0 0 0;">{{ $totalWorkingDays ?? 24 }}</p>
                                                                <p style="color: #1e3a8a; font-size: 13px; font-weight: 500; margin: 0;">Working Days</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Detailed Attendance Table -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Section Title -->
                                                        <tr>
                                                            <td colspan="6" style="padding-bottom: 15px;">
                                                                <p style="color: #1e293b; font-size: 18px; font-weight: 600; margin: 0;">Daily Attendance Details</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Table Header -->
                                                        <tr>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px; border-radius: 6px 0 0 0;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Date</p>
                                                            </td>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Status</p>
                                                            </td>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Check In</p>
                                                            </td>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Check Out</p>
                                                            </td>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Late</p>
                                                            </td>
                                                            <td style="background-color: #f1f5f9; padding: 12px 8px; border-radius: 0 6px 0 0;">
                                                                <p style="color: #475569; font-size: 13px; font-weight: 600; margin: 0; text-transform: uppercase;">Early Exit</p>
                                                            </td>
                                                        </tr>

                                                        @forelse($attendanceRecords ?? [] as $record)
                                                        <!-- Attendance Row -->
                                                        <tr>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; font-weight: 500; margin: 0;">{{ $record['date'] ?? 'Mar 01, 2026' }}</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                @php
                                                                    $statusColor = $record['status'] == 'Present' ? '#059669' : ($record['status'] == 'Absent' ? '#dc2626' : '#d97706');
                                                                    $statusBg = $record['status'] == 'Present' ? '#ecfdf5' : ($record['status'] == 'Absent' ? '#fef2f2' : '#fffbeb');
                                                                @endphp
                                                                <span style="display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: {{ $statusBg }}; color: {{ $statusColor }};">
                                                                    {{ $record['status'] ?? 'Present' }}
                                                                </span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">{{ $record['checkIn'] ?? '09:00 AM' }}</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">{{ $record['checkOut'] ?? '06:00 PM' }}</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                @if(($record['late'] ?? 0) > 0)
                                                                    <span style="color: #dc2626; font-size: 14px; font-weight: 600;">{{ $record['late'] ?? 0 }} min</span>
                                                                @else
                                                                    <span style="color: #10b981; font-size: 14px;">-</span>
                                                                @endif
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                @if(($record['earlyExit'] ?? 0) > 0)
                                                                    <span style="color: #dc2626; font-size: 14px; font-weight: 600;">{{ $record['earlyExit'] ?? 0 }} min</span>
                                                                @else
                                                                    <span style="color: #10b981; font-size: 14px;">-</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @empty
                                                        <!-- Sample Data Rows -->
                                                        <tr>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; font-weight: 500; margin: 0;">Mar 01, 2026</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: #ecfdf5; color: #059669;">Present</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">08:55 AM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">06:05 PM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #10b981; font-size: 14px;">-</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #10b981; font-size: 14px;">-</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; font-weight: 500; margin: 0;">Mar 02, 2026</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: #ecfdf5; color: #059669;">Present</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">09:15 AM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">06:30 PM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #dc2626; font-size: 14px; font-weight: 600;">15 min</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #10b981; font-size: 14px;">-</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; font-weight: 500; margin: 0;">Mar 03, 2026</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; background-color: #ecfdf5; color: #059669;">Present</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">08:45 AM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <p style="color: #334155; font-size: 14px; margin: 0; font-family: monospace;">05:45 PM</p>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #10b981; font-size: 14px;">-</span>
                                                            </td>
                                                            <td style="padding: 12px 8px; border-bottom: 1px solid #e2e8f0;">
                                                                <span style="color: #dc2626; font-size: 14px; font-weight: 600;">15 min</span>
                                                            </td>
                                                        </tr>
                                                        @endforelse
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Summary Statistics -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Section Title -->
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 15px;">
                                                                <p style="color: #1e293b; font-size: 18px; font-weight: 600; margin: 0;">Monthly Summary</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Total Present -->
                                                        <tr>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #64748b; font-size: 15px; margin: 0;">Total Present Days:</p>
                                                            </td>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #0f172a; font-weight: 600; font-size: 15px; margin: 0;">{{ $presentDays ?? 22 }} days</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Total Absent -->
                                                        <tr>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #64748b; font-size: 15px; margin: 0;">Total Absent Days:</p>
                                                            </td>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #0f172a; font-weight: 600; font-size: 15px; margin: 0;">{{ $absentDays ?? 2 }} days</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Total Late Minutes -->
                                                        <tr>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #64748b; font-size: 15px; margin: 0;">Total Late Minutes:</p>
                                                            </td>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #dc2626; font-weight: 600; font-size: 15px; margin: 0;">{{ $totalLateMinutes ?? 45 }} minutes</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Total Early Exit Minutes -->
                                                        <tr>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #64748b; font-size: 15px; margin: 0;">Total Early Exit Minutes:</p>
                                                            </td>
                                                            <td width="50%" style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <p style="color: #dc2626; font-weight: 600; font-size: 15px; margin: 0;">{{ $totalEarlyExitMinutes ?? 30 }} minutes</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Total Overtime Hours -->
                                                        <tr>
                                                            <td width="50%" style="padding: 8px 0;">
                                                                <p style="color: #64748b; font-size: 15px; margin: 0;">Total Overtime Hours:</p>
                                                            </td>
                                                            <td width="50%" style="padding: 8px 0;">
                                                                <p style="color: #059669; font-weight: 600; font-size: 15px; margin: 0;">{{ $totalOvertimeHours ?? 12.5 }} hours</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Overtime Details Card -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ecfdf5; border-radius: 8px; border: 1px solid #a7f3d0;">
                                            <tr>
                                                <td style="padding: 15px 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td width="30" style="vertical-align: middle;">
                                                                <span style="font-size: 24px;">⏰</span>
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <p style="color: #065f46; font-size: 16px; font-weight: 600; margin: 0;">Overtime Summary</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="padding-top: 10px;">
                                                                <p style="color: #047857; font-size: 14px; margin: 0 0 5px 0;">
                                                                    <strong>Total Overtime Hours:</strong> {{ $totalOvertimeHours ?? 12.5 }} hours
                                                                </p>
                                                                <p style="color: #047857; font-size: 14px; margin: 0 0 5px 0;">
                                                                    <strong>Overtime Rate:</strong> {{ $overtimeRate ?? '1.5x' }} of regular hourly rate
                                                                </p>
                                                                <p style="color: #047857; font-size: 14px; margin: 0;">
                                                                    <strong>Estimated Overtime Pay:</strong> {{ $currency ?? '$' }}{{ number_format($overtimePay ?? 375.00, 2) }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Important Notes -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fffbeb; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="color: #92400e; font-size: 16px; font-weight: 600; margin: 0 0 10px 0;">
                                                        📋 Important Notes:
                                                    </p>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Please report any discrepancies within 3 working days
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Late arrivals and early exits affect your attendance record
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Overtime hours are calculated based on approved requests only
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Use biometric or web check-in for accurate time tracking
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- CTA Button -->
                                <tr>
                                    <td align="center" style="padding: 20px 0 30px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: #7c3aed; border-radius: 6px;">
                                                    <a href="{{ $attendancePortalUrl ?? '#' }}" style="display: inline-block; padding: 14px 35px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 6px;">View Full Attendance Report</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- HR Contact -->
                                <tr>
                                    <td>
                                        <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">For attendance-related queries, please contact:</p>
                                        <p style="color: #1e293b; font-size: 16px; font-weight: 600; margin: 0 0 3px 0;">HR Department</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">Attendance Management Team</p>
                                        <p style="color: #7c3aed; font-size: 14px; margin: 5px 0 0 0;">
                                            <a href="mailto:{{ $attendanceEmail ?? 'attendance@company.com' }}" style="color: #7c3aed; text-decoration: none;">{{ $attendanceEmail ?? 'attendance@company.com' }}</a> |
                                            <a href="#" style="color: #7c3aed; text-decoration: none;">Attendance Portal</a>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 30px; border-radius: 0 0 12px 12px; border-top: 1px solid #e2e8f0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 15px;">
                                        <p style="color: #64748b; font-size: 14px; margin: 0; line-height: 1.5;">
                                            This is an automated message from the HR Management System.<br>
                                            Please do not reply to this email.
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Privacy Policy</a>
                                                </td>
                                                <td style="color: #cbd5e1;">|</td>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">HR Support</a>
                                                </td>
                                                <td style="color: #cbd5e1;">|</td>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Company Website</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-top: 15px;">
                                        <p style="color: #94a3b8; font-size: 12px; margin: 0;">
                                            &copy; {{ date('Y') }} {{ $companyName ?? 'Your Company Name' }}. All rights reserved.<br>
                                            {{ $companyAddress ?? '123 Business Avenue, Suite 100, City, State 12345' }}
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
