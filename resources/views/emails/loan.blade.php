<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loan Application Status Update</title>
</head>
@php
    $employee = $loan->employee;
    $employeeName = trim(($employee->first_name ?? '') . ' ' . ($employee->last_name ?? ''));
    $salutation = ($employee->gender ?? '') === 'male' ? 'Mr.' : (($employee->gender ?? '') === 'female' ? 'Ms.' : '');
    $displayName = trim($salutation . ' ' . ($employeeName !== '' ? $employeeName : 'Employee'));

    $statusKey = strtolower((string) ($loan->status ?? 'pending'));
    $statusLabel = ucfirst($statusKey);

    $statusBgColor = $statusKey === 'approved' ? '#ecfdf5' : ($statusKey === 'pending' ? '#fffbeb' : ($statusKey === 'rejected' ? '#fef2f2' : '#eff6ff'));
    $statusBorderColor = $statusKey === 'approved' ? '#059669' : ($statusKey === 'pending' ? '#d97706' : ($statusKey === 'rejected' ? '#dc2626' : '#2563eb'));
    $statusTextColor = $statusKey === 'approved' ? '#065f46' : ($statusKey === 'pending' ? '#92400e' : ($statusKey === 'rejected' ? '#991b1b' : '#1e40af'));

    $currencySymbol = $currency ?? '৳';
    $installments = max((int) ($loan->installments ?? 0), 0);
    $paidInstallments = $loan->installments_data ? $loan->installments_data->where('is_paid', 1)->count() : 0;
    $remainingInstallments = max($installments - $paidInstallments, 0);

    $firstInstallment = $loan->installments_data
        ? $loan->installments_data->sortBy(function ($item) {
            return sprintf('%04d-%02d', $item->year, $item->month);
        })->first()
        : null;

    $firstPaymentDate = $firstInstallment
        ? date('F 1, Y', mktime(0, 0, 0, (int) $firstInstallment->month, 1, (int) $firstInstallment->year))
        : 'N/A';

    $startMonthLabel = !empty($loan->start_month) ? date('F Y', strtotime($loan->start_month)) : 'N/A';
@endphp
<body style="margin: 10px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f7fa; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 900px; width: 100%; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 40px 30px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <img src="{{ customAsset(settingData('company_logo_path')) }}" alt="{{ settingData('company_name') }}" style="width: 60px; height: auto; margin-bottom: 15px;" onerror="this.style.display='none'">
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 600; margin: 10px 0 5px; line-height: 1.3;">Loan Management Information</h1>
                                        <p style="color: #d1fae5; font-size: 16px; margin: 0;">Your loan application has been processed</p>
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
                                        <p style="color: #374151; font-size: 18px; font-weight: 500; margin: 0;">Dear {{ $displayName }},</p>
                                    </td>
                                </tr>

                                <!-- Message -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #4b5563; font-size: 16px; line-height: 1.6; margin: 0;">
                                            We are pleased to inform you that your loan application has been <span style="color: {{ $statusTextColor }}; font-weight: 600;">{{ strtolower($statusLabel) }}</span>.
                                            Below are the detailed information regarding your loan:
                                        </p>
                                    </td>
                                </tr>

                                <!-- Status Banner -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: {{ $statusBgColor }}; border-radius: 8px; border-left: 4px solid {{ $statusBorderColor }};">
                                            <tr>
                                                <td style="padding: 15px 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td width="30" style="vertical-align: middle;">
                                                                @if($statusKey == 'approved')
                                                                    <span style="font-size: 24px;">✅</span>
                                                                @elseif($statusKey == 'pending')
                                                                    <span style="font-size: 24px;">⏳</span>
                                                                @elseif($statusKey == 'rejected')
                                                                    <span style="font-size: 24px;">❌</span>
                                                                @else
                                                                    <span style="font-size: 24px;">ℹ️</span>
                                                                @endif
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                <p style="color: {{ $statusTextColor }}; font-size: 18px; font-weight: 600; margin: 0;">
                                                                    Loan Status: {{ $statusLabel }}
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Loan Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Section Title -->
                                                        <tr>
                                                            <td colspan="2" style="padding-bottom: 15px;">
                                                                <p style="color: #1e293b; font-size: 18px; font-weight: 600; margin: 0;">Loan Summary</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Branch -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">🏢 Branch:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 15px;">{{ $loan->branch->name ?? 'N/A' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Employee Name -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">👤 Employee Name:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 15px;">{{ $employeeName !== '' ? $employeeName : 'N/A' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Employee ID (Additional) -->
                                                        @if(!empty($employee->employee_code))
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">🆔 Employee ID:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 500; font-size: 15px;">{{ $employee->employee_code }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        <!-- Loan Amount -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">💰 Loan Amount:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 700; font-size: 18px; color: #059669;">{{ $currencySymbol }}{{ number_format($loan->amount ?? 0, 2) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Number of Installments -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">📊 Number of Installments:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 15px;">{{ $installments }} Months</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- EMI Amount -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">💳 EMI Amount:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 16px;">{{ $currencySymbol }}{{ number_format($loan->emi_amount ?? 0, 2) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Remaining Amount -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">📉 Remaining Amount:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 16px;">{{ $currencySymbol }}{{ number_format($loan->remaining_amount ?? 0, 2) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Start Month -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">📅 Start Month:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #0f172a; font-weight: 600; font-size: 15px;">{{ $startMonthLabel }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Status -->
                                                        <tr>
                                                            <td width="40%" style="padding: 12px 0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td style="color: #64748b; font-size: 15px;">📌 Status:</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="60%" style="padding: 12px 0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td>
                                                                            <span style="display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 13px; font-weight: 600;
                                                                                background-color: {{ $statusKey == 'approved' ? '#d1fae5' : ($statusKey == 'pending' ? '#fef3c7' : ($statusKey == 'rejected' ? '#fee2e2' : '#dbeafe')) }};
                                                                                color: {{ $statusTextColor }};">
                                                                                {{ $statusLabel }}
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Loan Repayment Schedule Summary -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="color: #1e40af; font-size: 16px; font-weight: 600; margin: 0 0 10px 0;">
                                                        📅 Repayment Schedule Summary:
                                                    </p>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • First Payment Date: {{ $firstPaymentDate }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Payment Frequency: Monthly
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Payment Method: Auto-deduct from salary
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Installments Paid: {{ $paidInstallments }} of {{ $installments }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Remaining Installments: {{ $remainingInstallments }}
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
                                                                • EMI will be automatically deducted from your salary each month
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Late payments may incur additional charges
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • For prepayment, please contact the HR department
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #92400e; font-size: 14px; line-height: 1.6;">
                                                                • Keep track of your remaining balance through the employee portal
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
                                                <td style="background-color: #059669; border-radius: 6px;">
                                                    <a href="{{ url('/') }}" style="display: inline-block; padding: 14px 35px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 6px;">View Loan Details</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Contact Information -->
                                <tr>
                                    <td>
                                        <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">If you have any questions, please contact:</p>
                                        <p style="color: #1e293b; font-size: 16px; font-weight: 600; margin: 0 0 3px 0;">Finance Department</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">Loan Management Team</p>
                                        <p style="color: #059669; font-size: 14px; margin: 5px 0 0 0;">
                                            <a href="mailto:{{ settingData('email_address') }}" style="color: #059669; text-decoration: none;">{{ settingData('email_address') }}</a> |
                                            <a href="#" style="color: #059669; text-decoration: none;">Loan Portal</a>
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
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Finance Support</a>
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
                                            &copy; {{ date('Y') }} {{ settingData('company_name') }}. All rights reserved.<br>
                                            {{ settingData('company_address') }}
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
