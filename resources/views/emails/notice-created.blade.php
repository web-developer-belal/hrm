<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Notice</title>
</head>
<body style="margin:0;padding:0;background:#f3f4f6;font-family:Arial,Helvetica,sans-serif;">
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="background:#f3f4f6;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="640" cellspacing="0" cellpadding="0" style="max-width:640px;width:100%;background:#ffffff;border-radius:10px;overflow:hidden;">
                    <tr>
                        <td style="background:#1d4ed8;padding:24px 28px;">
                            <h1 style="margin:0;color:#ffffff;font-size:22px;line-height:1.3;">New Notice Published</h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:24px 28px;">
                            <p style="margin:0 0 12px 0;color:#111827;font-size:15px;line-height:1.7;">
                                Dear {{ $employee->full_name ?? ($employee->first_name ?? 'Employee') }},
                            </p>
                            <p style="margin:0 0 16px 0;color:#374151;font-size:14px;line-height:1.7;">
                                A new notice has been created for your branch/department.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border:1px solid #e5e7eb;border-radius:8px;background:#f9fafb;">
                                <tr>
                                    <td style="padding:16px;">
                                        <p style="margin:0 0 10px 0;color:#111827;font-size:18px;font-weight:700;">{{ $notice->title }}</p>
                                        <p style="margin:0 0 10px 0;color:#6b7280;font-size:13px;">Date: {{ optional($notice->created_at)->format('F j, Y, g:i A') }}</p>
                                        <p style="margin:0;color:#374151;font-size:14px;line-height:1.7;">
                                            {!! $notice->description !!}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin:16px 0 0 0;color:#374151;font-size:14px;line-height:1.7;">
                                Please login to your account to view full notice details and attachments.
                            </p>
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
