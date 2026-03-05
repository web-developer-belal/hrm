<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Company Notice' }} - {{ $companyName ?? 'Company Name' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="margin: 10px; padding: 10px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7fa;">
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f4f7fa; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" border="0" style="max-width: 900px; width: 100%; background-color: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);">
                    <!-- Header - Dynamic based on type -->
                    <tr>
                        <td style="background: linear-gradient(135deg, {{ $type == 'event' ? '#ea580c' : ($type == 'urgent' ? '#dc2626' : '#2563eb') }} 0%, {{ $type == 'event' ? '#9a3412' : ($type == 'urgent' ? '#991b1b' : '#1e40af') }} 100%); padding: 40px 30px; border-radius: 12px 12px 0 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td align="center">
                                        <img src="{{ asset('images/logo-white.png') }}" alt="{{ $companyName ?? 'Company Logo' }}" style="width: 60px; height: auto; margin-bottom: 15px;" onerror="this.style.display='none'">
                                        <h1 style="color: #ffffff; font-size: 32px; font-weight: 700; margin: 10px 0 5px; line-height: 1.3;">
                                            @if($type == 'event')
                                                🎉 {{ $title ?? 'Company Event' }}
                                            @elseif($type == 'urgent')
                                                ⚠️ {{ $title ?? 'Urgent Notice' }}
                                            @else
                                                📢 {{ $title ?? 'Company Announcement' }}
                                            @endif
                                        </h1>
                                        <p style="color: #e0e7ff; font-size: 16px; margin: 0;">{{ $subtitle ?? 'Important information for all employees' }}</p>
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
                                        <p style="color: #374151; font-size: 18px; font-weight: 500; margin: 0;">
                                            Dear {{ $employeeName ?? 'Valued Employee' }},
                                        </p>
                                    </td>
                                </tr>

                                <!-- Message -->
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <p style="color: #4b5563; font-size: 16px; line-height: 1.8; margin: 0;">
                                            {{ $message ?? 'We would like to bring to your attention the following important information:' }}
                                        </p>
                                    </td>
                                </tr>

                                <!-- Notice/Event Details Card -->
                                <tr>
                                    <td style="padding-bottom: 30px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                                            <tr>
                                                <td style="padding: 25px;">
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <!-- Announcement/Notice Content -->
                                                        <tr>
                                                            <td style="padding-bottom: 20px;">
                                                                <div style="color: #1e293b; font-size: 16px; line-height: 1.8;">
                                                                    {!! $content ?? '<p>This is an important announcement regarding company policies and procedures. Please read carefully and take necessary actions.</p>' !!}
                                                                </div>
                                                            </td>
                                                        </tr>

                                                        @if($type == 'event')
                                                        <!-- Event Specific Details -->
                                                        <tr>
                                                            <td style="padding-top: 15px; border-top: 2px dashed #e2e8f0;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td colspan="2" style="padding: 15px 0 10px 0;">
                                                                            <p style="color: #0f172a; font-size: 18px; font-weight: 600; margin: 0;">🎪 Event Details</p>
                                                                        </td>
                                                                    </tr>

                                                                    <!-- Event Date -->
                                                                    <tr>
                                                                        <td width="35%" style="padding: 8px 0; color: #64748b; font-size: 15px;">📅 Date:</td>
                                                                        <td width="65%" style="padding: 8px 0; color: #0f172a; font-weight: 500; font-size: 15px;">{{ $eventDate ?? 'Friday, March 15, 2026' }}</td>
                                                                    </tr>

                                                                    <!-- Event Time -->
                                                                    <tr>
                                                                        <td width="35%" style="padding: 8px 0; color: #64748b; font-size: 15px;">⏰ Time:</td>
                                                                        <td width="65%" style="padding: 8px 0; color: #0f172a; font-weight: 500; font-size: 15px;">{{ $eventTime ?? '3:00 PM - 6:00 PM' }}</td>
                                                                    </tr>

                                                                    <!-- Event Location -->
                                                                    <tr>
                                                                        <td width="35%" style="padding: 8px 0; color: #64748b; font-size: 15px;">📍 Location:</td>
                                                                        <td width="65%" style="padding: 8px 0; color: #0f172a; font-weight: 500; font-size: 15px;">{{ $eventLocation ?? 'Main Conference Hall - 5th Floor' }}</td>
                                                                    </tr>

                                                                    <!-- RSVP -->
                                                                    @if(isset($rsvpRequired) && $rsvpRequired)
                                                                    <tr>
                                                                        <td width="35%" style="padding: 8px 0; color: #64748b; font-size: 15px;">✅ RSVP By:</td>
                                                                        <td width="65%" style="padding: 8px 0; color: #ea580c; font-weight: 600; font-size: 15px;">{{ $rsvpDeadline ?? 'March 10, 2026' }}</td>
                                                                    </tr>
                                                                    @endif
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @if($type == 'urgent')
                                                        <!-- Urgent Notice Banner -->
                                                        <tr>
                                                            <td style="padding-top: 20px;">
                                                                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #fef2f2; border-radius: 8px; border: 1px solid #fecaca;">
                                                                    <tr>
                                                                        <td style="padding: 15px;">
                                                                            <p style="color: #991b1b; font-size: 15px; font-weight: 600; margin: 0 0 5px 0;">⚠️ Action Required</p>
                                                                            <p style="color: #b91c1c; font-size: 14px; margin: 0; line-height: 1.6;">
                                                                                {{ $actionRequired ?? 'Please review this notice immediately and take necessary action by the deadline.' }}
                                                                            </p>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Key Points / Highlights -->
                                @if(isset($highlights) && count($highlights) > 0)
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #eff6ff; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="color: #1e40af; font-size: 16px; font-weight: 600; margin: 0 0 15px 0;">
                                                        ✨ Key Highlights:
                                                    </p>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        @foreach($highlights as $highlight)
                                                        <tr>
                                                            <td style="padding: 6px 0; color: #1e3a8a; font-size: 14px; line-height: 1.6;">
                                                                • {{ $highlight }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <!-- Important Dates / Deadlines -->
                                @if(isset($importantDates) && count($importantDates) > 0)
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #f0fdf4; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 20px;">
                                                    <p style="color: #166534; font-size: 16px; font-weight: 600; margin: 0 0 15px 0;">
                                                        📅 Important Dates:
                                                    </p>
                                                    @foreach($importantDates as $date)
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 10px;">
                                                        <tr>
                                                            <td width="30" style="vertical-align: top; color: #166534;">•</td>
                                                            <td style="color: #166534; font-size: 14px; line-height: 1.6;">
                                                                <strong>{{ $date['date'] }}:</strong> {{ $date['description'] }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <!-- Attachments Section -->
                                @if(isset($attachments) && count($attachments) > 0)
                                <tr>
                                    <td style="padding-bottom: 25px;">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color: #faf5ff; border-radius: 8px;">
                                            <tr>
                                                <td style="padding: 15px 20px;">
                                                    <p style="color: #6b21a5; font-size: 15px; font-weight: 600; margin: 0 0 10px 0;">
                                                        📎 Attachments:
                                                    </p>
                                                    @foreach($attachments as $attachment)
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 8px;">
                                                        <tr>
                                                            <td width="25" style="vertical-align: middle;">
                                                                <span style="font-size: 16px;">📄</span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ $attachment['url'] }}" style="color: #7c3aed; text-decoration: none; font-size: 14px;">{{ $attachment['name'] }}</a>
                                                                <span style="color: #94a3b8; font-size: 12px; margin-left: 8px;">({{ $attachment['size'] }})</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <!-- CTA Button -->
                                @if(isset($ctaText) && isset($ctaUrl))
                                <tr>
                                    <td align="center" style="padding: 20px 0 30px;">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td style="background-color: {{ $type == 'event' ? '#ea580c' : ($type == 'urgent' ? '#dc2626' : '#2563eb') }}; border-radius: 6px;">
                                                    <a href="{{ $ctaUrl }}" style="display: inline-block; padding: 14px 35px; color: #ffffff; text-decoration: none; font-size: 16px; font-weight: 600; border-radius: 6px;">{{ $ctaText }}</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                @endif

                                <!-- Contact Information -->
                                <tr>
                                    <td style="padding-top: 15px; border-top: 1px solid #e2e8f0;">
                                        <p style="color: #4b5563; font-size: 15px; margin: 0 0 5px 0;">For questions or more information, please contact:</p>
                                        <p style="color: #1e293b; font-size: 16px; font-weight: 600; margin: 0 0 3px 0;">{{ $contactPerson ?? 'HR Department' }}</p>
                                        <p style="color: #64748b; font-size: 14px; margin: 0;">{{ $contactTitle ?? 'Human Resources Team' }}</p>
                                        <p style="color: #2563eb; font-size: 14px; margin: 5px 0 0 0;">
                                            <a href="mailto:{{ $contactEmail ?? 'hr@company.com' }}" style="color: #2563eb; text-decoration: none;">{{ $contactEmail ?? 'hr@company.com' }}</a>
                                            @if(isset($contactPhone))
                                             | <span style="color: #64748b;">{{ $contactPhone }}</span>
                                            @endif
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
                                            This is an official communication from {{ $companyName ?? 'the company' }}.<br>
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
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Unsubscribe</a>
                                                </td>
                                                <td style="color: #cbd5e1;">|</td>
                                                <td style="padding: 0 10px;">
                                                    <a href="#" style="color: #475569; font-size: 13px; text-decoration: none;">Company Intranet</a>
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
