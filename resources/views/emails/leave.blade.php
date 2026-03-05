<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Leave Approval Email</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="margin: 10px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f7fa; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 900px; width: 100%; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%); padding: 40px 30px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <img src="{{ asset('images/logo-white.png') }}" alt="Company Logo" style="width: 60px; height: auto; margin-bottom: 15px;" onerror="this.style.display='none'">
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 600; margin: 10px 0 5px; line-height: 1.3;">Leave Request Approved</h1>
                                        <p style="color: #e0e7ff; font-size: 16px; margin: 0;">Your leave has been successfully approved</p>
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
                                        <p style="color: #374151; font-size: 18px; font-weight: 500; margin: 0;">Dear John Doe,</p>
                                    </td>
                                </tr>

                                <!-- Message -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #4b5563; font-size: 16px; line-height: 1.6; margin: 0;">
                                            We are pleased to inform you that your leave request has been <span style="color: #059669; font-weight: 600;">approved</span>.
                                            Below are the details of your approved leave:
                                        </p>
                                    </td>
                                </tr>

                                <!-- Leave Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Leave Type -->
                                                        <tr>
                                                            <td width="40%" style="padding: 10px 0; color: #64748b; font-size: 15px;">Leave Type:</td>
                                                            <td width="60%" style="padding: 10px 0; color: #0f172a; font-weight: 500; font-size: 15px;">Annual Leave</td>
                                                        </tr>
                                                        <!-- Duration -->
                                                        <tr>
                                                            <td width="40%" style="padding: 10px 0; color: #64748b; font-size: 15px;">Duration:</td>
                                                            <td width="60%" style="padding: 10px 0; color: #0f172a; font-weight: 500; font-size: 15px;">3 Days</td>
                                                        </tr>
                                                        <!-- Start Date -->
                                                        <tr>
                                                            <td width="40%" style="padding: 10px 0; color: #64748b; font-size: 15px;">Start Date:</td>
                                                            <td width="60%" style="padding: 10px 0; color: #0f172a; font-weight: 500; font-size: 15px;">March 10, 2026</td>
                                                        </tr>
                                                        <!-- End Date -->
                                                        <tr>
                                                            <td width="40%" style="padding: 10px 0; color: #64748b; font-size: 15px;">End Date:</td>
                                                            <td width="60%" style="padding: 10px 0; color: #0f172a; font-weight: 500; font-size: 15px;">March 12, 2026</td>
                                                        </tr>
                                                        <!-- Total Days -->
                                                        <tr>
                                                            <td width="40%" style="padding: 10px 0; color: #64748b; font-size: 15px;">Total Days:</td>
                                                            <td width="60%" style="padding: 10px 0; color: #0f172a; font-weight: 600; font-size: 16px;">3 Working Days</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Additional Information -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="color: #374151; font-size: 16px; font-weight: 600; padding-bottom: 10px;">Additional Information:</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #4b5563; font-size: 15px; line-height: 1.6; padding-bottom: 10px;">
                                                    <strong>Reason:</strong> Family vacation
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #4b5563; font-size: 15px; line-height: 1.6; padding-bottom: 5px;">
                                                    <strong>Approved By:</strong> Jane Smith (HR Manager)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #4b5563; font-size: 15px; line-height: 1.6;">
                                                    <strong>Approval Date:</strong> March 5, 2026
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Balance Information -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 15px 20px;">
                                                    <p style="color: #1e40af; font-size: 15px; font-weight: 500; margin: 0;">
                                                        Remaining Leave Balance: <span style="color: #2563eb; font-weight: 600;">12 Days</span>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Notes -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #6b7280; font-size: 14px; font-style: italic; margin: 0; border-left: 3px solid #2563eb; padding-left: 15px;">
                                            Please ensure all pending tasks are properly handed over before proceeding on leave.
                                        </p>
                                    </td>
                                </tr>

                                <!-- CTA Button -->
                                <tr>
                                    <td align="center" style="padding: 20px 0 30px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: #2563eb; border-radius: 6px;">
                                                    <a href="#" style="display: inline-block; padding: 12px 30px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 500;">View Leave Details</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- HR Contact -->
                                <tr>
                                    <td>
                                        <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">Best regards,</p>
                                        <p style="color: #1e293b; font-size: 16px; font-weight: 600; margin: 0 0 3px 0;">HR Department</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">Human Resources Team</p>
                                        <p style="color: #2563eb; font-size: 14px; margin: 5px 0 0 0;">
                                            <a href="mailto:hr@company.com" style="color: #2563eb; text-decoration: none;">hr@company.com</a> |
                                            <a href="#" style="color: #2563eb; text-decoration: none;">Company Portal</a>
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
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Contact Support</a>
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
                                            &copy; 2026 Your Company Name. All rights reserved.<br>
                                            123 Business Avenue, Suite 100, City, State 12345
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
