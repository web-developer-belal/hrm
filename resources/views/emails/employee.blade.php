<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Login Credentials</title>
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
                                        <img src="{{ asset('images/logo-white.png') }}" alt="{{ $companyName ?? 'Company Logo' }}" style="width: 60px; height: auto; margin-bottom: 15px;" onerror="this.style.display='none'">
                                        <h1 style="color: #ffffff; font-size: 28px; font-weight: 600; margin: 10px 0 5px; line-height: 1.3;">Welcome to {{ $companyName ?? 'Our Company' }}</h1>
                                        <p style="color: #e0e7ff; font-size: 16px; margin: 0;">Your Employee Account Has Been Created</p>
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
                                            Your employee account has been successfully created in our HR Management System.
                                            Below are your login credentials. Please keep this information secure and
                                            change your password after your first login.
                                        </p>
                                    </td>
                                </tr>

                                <!-- Credentials Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 25px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Security Notice -->
                                                        <tr>
                                                            <td align="center" style="padding-bottom: 20px;">
                                                                <span style="background-color: #fef3c7; color: #92400e; padding: 6px 15px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                                                                    ⚠️ CONFIDENTIAL INFORMATION
                                                                </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Employee ID -->
                                                        <tr>
                                                            <td style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Employee ID:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 600; font-size: 16px;">{{ $employeeId ?? 'EMP-'.date('Y').rand(1000,9999) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Username -->
                                                        <tr>
                                                            <td style="padding: 12px 0; border-bottom: 1px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Username:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 600; font-size: 16px; font-family: monospace;">{{ $username ?? strtolower(str_replace(' ', '.', $employeeName)).'@company.com' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Password -->
                                                        <tr>
                                                            <td style="padding: 12px 0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Temporary Password:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 600; font-size: 16px; font-family: monospace; letter-spacing: 1px;">{{ $temporaryPassword ?? 'Temp@'.rand(1000,9999) }}</td>
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

                                <!-- Employee Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Section Title -->
                                                        <tr>
                                                            <td style="padding-bottom: 15px;">
                                                                <p style="color: #1e293b; font-size: 18px; font-weight: 600; margin: 0;">Employee Information</p>
                                                            </td>
                                                        </tr>

                                                        <!-- Department -->
                                                        <tr>
                                                            <td style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Department:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 500; font-size: 15px;">{{ $department ?? 'Information Technology' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Position -->
                                                        <tr>
                                                            <td style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Position:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 500; font-size: 15px;">{{ $position ?? 'Software Developer' }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Joining Date -->
                                                        <tr>
                                                            <td style="padding: 8px 0; border-bottom: 1px solid #f1f5f9;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Joining Date:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 500; font-size: 15px;">{{ $joiningDate ?? date('F d, Y') }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>

                                                        <!-- Employment Type -->
                                                        <tr>
                                                            <td style="padding: 8px 0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td width="40%" style="color: #64748b; font-size: 15px;">Employment Type:</td>
                                                                        <td width="60%" style="color: #0f172a; font-weight: 500; font-size: 15px;">{{ $employmentType ?? 'Full-Time' }}</td>
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

                                <!-- Important Instructions -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="color: #1e40af; font-size: 16px; font-weight: 600; margin: 0 0 15px 0;">
                                                        📋 Important Instructions:
                                                    </p>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Change your password immediately after first login
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Never share your login credentials with anyone
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Use a strong password with mix of letters, numbers, and symbols
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • Bookmark the login page for easy access
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Login Button -->
                                <tr>
                                    <td align="center" style="padding: 20px 0 30px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: #2563eb; border-radius: 6px;">
                                                    <a href="{{ $loginUrl ?? '#' }}" style="display: inline-block; padding: 14px 35px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 6px;">Access Employee Portal</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Login Details -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 15px;">
                                                    <p style="color: #475569; font-size: 14px; margin: 0; line-height: 1.6;">
                                                        <strong>Portal URL:</strong> <a href="{{ $loginUrl ?? '#' }}" style="color: #2563eb; text-decoration: none;">{{ $loginUrl ?? 'https://portal.company.com/login' }}</a><br>
                                                        <strong>Help Desk:</strong> {{ $helpDeskEmail ?? 'support@company.com' }} | {{ $helpDeskPhone ?? '+1 (555) 123-4567' }}<br>
                                                        <strong>IT Support Hours:</strong> Monday - Friday, 9:00 AM - 6:00 PM
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- HR Contact -->
                                <tr>
                                    <td>
                                        <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">Welcome aboard!</p>
                                        <p style="color: #1e293b; font-size: 16px; font-weight: 600; margin: 0 0 3px 0;">HR Department</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">Human Resources Team</p>
                                        <p style="color: #2563eb; font-size: 14px; margin: 5px 0 0 0;">
                                            <a href="mailto:{{ $companyEmail ?? 'hr@company.com' }}" style="color: #2563eb; text-decoration: none;">{{ $companyEmail ?? 'hr@company.com' }}</a> |
                                            <a href="#" style="color: #2563eb; text-decoration: none;">Employee Portal</a>
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
                                            This email contains confidential information. If you received this by mistake,<br>
                                            please contact {{ $companyEmail ?? 'hr@company.com' }} immediately and delete this email.
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
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">IT Support</a>
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
