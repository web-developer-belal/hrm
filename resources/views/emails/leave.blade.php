<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Status Update</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">
    @php
        $employee = $leave->employee;
        $leaveType = $leave->type;
        $status = strtolower((string) $leave->status);
        $isApproved = $status === 'approved';
        $statusColor = $isApproved ? '#059669' : '#dc2626';
        $statusLabel = ucfirst($status);
    @endphp

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" style="max-width:640px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;">
                    <tr>
                        <td style="background:{{ $isApproved ? '#065f46' : '#991b1b' }};padding:24px 28px;">
                            <h1 style="margin:0;color:#ffffff;font-size:22px;line-height:1.3;">Leave Request {{ $statusLabel }}</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px 28px;">
                            <p style="margin:0 0 12px 0;color:#111827;font-size:15px;line-height:1.7;">
                                Dear {{ $employee->full_name ?? ($employee->first_name ?? 'Employee') }},
                            </p>

                            <p style="margin:0 0 16px 0;color:#374151;font-size:14px;line-height:1.7;">
                                Your leave request has been
                                <strong style="color:{{ $statusColor }};">{{ $statusLabel }}</strong>.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">
                                <tr>
                                    <td style="padding:16px;">
                                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;color:#111827;">
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;width:38%;">Leave Type</td>
                                                <td style="padding:6px 0;">{{ $leaveType->name ?? '--' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">From Date</td>
                                                <td style="padding:6px 0;">{{ optional($leave->from_date)->format('F j, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">To Date</td>
                                                <td style="padding:6px 0;">{{ optional($leave->to_date)->format('F j, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">Total Days</td>
                                                <td style="padding:6px 0;">{{ $leave->total_days ?? '--' }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">Status</td>
                                                <td style="padding:6px 0;color:{{ $statusColor }};font-weight:700;">{{ $statusLabel }}</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:6px 0;color:#6b7280;">Updated By</td>
                                                <td style="padding:6px 0;">{{ $leave->approver->full_name ?? 'HR Team' }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            @if(!empty($leave->descriptions))
                                <p style="margin:14px 0 0 0;color:#374151;font-size:14px;line-height:1.7;">
                                    <strong>Reason:</strong> {{ $leave->descriptions }}
                                </p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;background:#f9fafb;border-top:1px solid #e5e7eb;">
                            <p style="margin:0;color:#6b7280;font-size:12px;line-height:1.6;">
                                This is an automated email from HRM.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
