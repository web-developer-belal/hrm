<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function leaveApprovalEmail()
    {
        $data = [
            'employeeName' => 'John Doe',
            'leaveType' => 'Annual Leave',
            'duration' => '3 Days',
            'startDate' => 'March 10, 2026',
            'endDate' => 'March 12, 2026',
            'totalDays' => '3 Working Days',
            'reason' => 'Family vacation',
            'approvedBy' => 'Jane Smith (HR Manager)',
            'approvalDate' => 'March 5, 2026',
            'remainingBalance' => '12 Days',
            'companyName' => 'Your Company Name',
            'companyEmail' => 'hr@company.com',
            'companyAddress' => '123 Business Avenue, Suite 100, City, State 12345'
        ];

        return view('emails.leave', $data);
    }

    public function payslipEmail()
    {
        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyInitials' => 'AC',
            'companyEmail' => 'payroll@abc.com',
            'companyPhone' => '+1 (555) 987-6543',
            'companyAddress' => '456 Corporate Blvd, Suite 200, Business City, ST 67890',
            'currency' => '৳',

            // Employee Information
            'employeeName' => 'Jane Smith',
            'employeeId' => 'EMP-2025-0456',
            'department' => 'Marketing',
            'designation' => 'Marketing Manager',

            // Pay Period Information
            'month' => 'March',
            'year' => '2026',
            'payPeriod' => '01 Mar 2026 - 31 Mar 2026',
            'paymentDate' => '31 Mar 2026',

            // Earnings
            'basicSalary' => 6500.00,
            'housingAllowance' => 1800.00,
            'transportAllowance' => 600.00,
            'mealAllowance' => 350.00,
            'performanceBonus' => 1000.00,
            'totalEarnings' => 10250.00,

            // Deductions
            'incomeTax' => 1250.00,
            'socialSecurity' => 410.00,
            'healthInsurance' => 320.00,
            'loanDeduction' => 250.00,
            'totalDeductions' => 2230.00,

            // Net Pay
            'netPay' => 8020.00,

            // Bank Information
            'bankName' => 'Global Trust Bank',
            'lastFourDigits' => '5678',
            'accountType' => 'Checking',
            'transactionRef' => 'TXN' . date('Ymd') . rand(100, 999),

            // Year to Date
            'ytdGross' => 28750.00,
            'ytdTaxes' => 4890.00,
            'ytdNet' => 23860.00
        ];

        return view('emails.payslip', $data);
    }

    public function sendLeaveApprovalEmail(Request $request)
    {
        $request->validate([
            'employee_email' => 'required|email',
            'employee_name' => 'required|string',
            'leave_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'reason' => 'nullable|string',
        ]);

        $emailData = [
            'employeeName' => $request->employee_name,
            'leaveType' => $request->leave_type,
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
            'reason' => $request->reason,
            'approvedBy' => auth()->user()->name ?? 'HR Manager',
            'approvalDate' => now()->format('F j, Y'),
            'remainingBalance' => $request->remaining_balance ?? '12 Days',
        ];

        // Mail::to($request->employee_email)->send(new LeaveApprovedMail($emailData));

        return response()->json([
            'success' => true,
            'message' => 'Leave approval email sent successfully!',
            'data' => $emailData
        ]);
    }
    public function sendPayslipEmail(Request $request)
    {
        $request->validate([
            'employee_email' => 'required|email',
            'employee_id' => 'required|string',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payslip email sent successfully!'
        ]);
    }

    public function employeeCredentialsEmail()
    {
       $employee=Employee::first();

        return view('emails.employee', compact('employee'));
    }

    public function sendEmployeeCredentialsEmail(Request $request)
    {
        $request->validate([
            'employee_email' => 'required|email',
            'employee_name' => 'required|string',
            'employee_id' => 'required|string',
            'department' => 'required|string',
            'position' => 'required|string',
        ]);

        $emailData = [
            // Company Information
            'companyName' => $request->company_name ?? 'ABC Corporation',
            'companyEmail' => $request->company_email ?? 'hr@company.com',
            'companyAddress' => $request->company_address ?? '123 Business Avenue, City, State',

            // Employee Information
            'employeeName' => $request->employee_name,
            'employeeId' => $request->employee_id,
            'department' => $request->department,
            'position' => $request->position,
            'joiningDate' => $request->joining_date ?? date('F d, Y'),
            'employmentType' => $request->employment_type ?? 'Full-Time',

            // Login Credentials
            'username' => $request->username ?? $request->employee_email,
            'temporaryPassword' => $request->temporary_password ?? 'Temp@' . rand(1000, 9999),

            // Login Details
            'loginUrl' => $request->login_url ?? 'https://portal.company.com/login',
            'helpDeskEmail' => $request->help_desk_email ?? 'support@company.com',
            'helpDeskPhone' => $request->help_desk_phone ?? '+1 (555) 123-4567',
        ];

        // Uncomment this when you have the mail class ready
        // Mail::to($request->employee_email)->send(new EmployeeCredentialsMail($emailData));

        return response()->json([
            'success' => true,
            'message' => 'Employee credentials email sent successfully!',
            'data' => $emailData
        ]);
    }

    public function loanManagementEmail()
    {
        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyEmail' => 'finance@abccorporation.com',
            'companyAddress' => '123 Business Avenue, Suite 100, New York, NY 10001',
            'currency' => '৳',
            'financeEmail' => 'loans@abccorporation.com',

            // Employee Information
            'employeeName' => 'Robert Wilson',
            'employeeId' => 'EMP-2026-0345',

            // Loan Information (Your specified parameters)
            'branch' => 'Downtown Branch',
            'amount' => 15000.00,
            'installment' => 24,
            'emiAmount' => 685.50,
            'remainingAmount' => 14250.00,
            'startMonth' => 'May 2026',
            'status' => 'Approved',

            // Additional Loan Details
            'totalInterest' => 1452.00,
            'firstPaymentDate' => 'June 1, 2026',
            'loanPortalUrl' => 'https://portal.abccorporation.com/loans',
            'loanId' => 'LN-2026-0042',
            'interestRate' => '8.5%',
            'purpose' => 'Home Renovation',
            'approvedBy' => 'Sarah Johnson (Finance Manager)',
            'approvalDate' => date('F d, Y'),
        ];

        return view('emails.loan', $data);
    }

    /**
     * Send loan management email
     */
    public function sendLoanManagementEmail(Request $request)
    {
        $request->validate([
            'employee_email' => 'required|email',
            'employee_name' => 'required|string',
            'employee_id' => 'required|string',
            'branch' => 'required|string',
            'amount' => 'required|numeric',
            'installment' => 'required|integer',
            'emi_amount' => 'required|numeric',
            'remaining_amount' => 'required|numeric',
            'start_month' => 'required|string',
            'status' => 'required|string|in:Approved,Pending,Rejected,Processing',
        ]);

        $emailData = [
            // Company Information
            'companyName' => $request->company_name ?? 'ABC Corporation',
            'companyEmail' => $request->company_email ?? 'finance@company.com',
            'companyAddress' => $request->company_address ?? '123 Business Avenue, City, State',
            'currency' => $request->currency ?? '$',
            'financeEmail' => $request->finance_email ?? 'loans@company.com',

            // Employee Information
            'employeeName' => $request->employee_name,
            'employeeId' => $request->employee_id,

            // Loan Information (Your specified parameters)
            'branch' => $request->branch,
            'amount' => $request->amount,
            'installment' => $request->installment,
            'emiAmount' => $request->emi_amount,
            'remainingAmount' => $request->remaining_amount,
            'startMonth' => $request->start_month,
            'status' => $request->status,

            // Additional Loan Details
            'totalInterest' => $request->total_interest ?? ($request->amount * 0.085),
            'firstPaymentDate' => $request->first_payment_date ?? date('F d, Y', strtotime('+1 month')),
            'loanPortalUrl' => $request->loan_portal_url ?? 'https://portal.company.com/loans',
            'loanId' => $request->loan_id ?? 'LN-' . date('Y') . rand(1000, 9999),
            'interestRate' => $request->interest_rate ?? '8.5%',
            'purpose' => $request->purpose ?? 'Personal Loan',
            'approvedBy' => $request->approved_by ?? auth()->user()->name ?? 'Finance Manager',
            'approvalDate' => $request->approval_date ?? now()->format('F d, Y'),
        ];

        // Uncomment this when you have the mail class ready
        // Mail::to($request->employee_email)->send(new LoanManagementMail($emailData));

        return response()->json([
            'success' => true,
            'message' => 'Loan management email sent successfully!',
            'data' => $emailData
        ]);
    }

    public function monthlyAttendanceEmail()
    {
        // Sample attendance records for the month
        $attendanceRecords = [
            ['date' => 'Mar 01, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:05 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 02, 2026', 'status' => 'Present', 'checkIn' => '09:15 AM', 'checkOut' => '06:30 PM', 'late' => 15, 'earlyExit' => 0, 'overtime' => 1.0],
            ['date' => 'Mar 03, 2026', 'status' => 'Present', 'checkIn' => '08:45 AM', 'checkOut' => '05:45 PM', 'late' => 0, 'earlyExit' => 15, 'overtime' => 0],
            ['date' => 'Mar 04, 2026', 'status' => 'Present', 'checkIn' => '08:50 AM', 'checkOut' => '07:15 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 1.5],
            ['date' => 'Mar 05, 2026', 'status' => 'Present', 'checkIn' => '09:05 AM', 'checkOut' => '06:20 PM', 'late' => 5, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 06, 2026', 'status' => 'Present', 'checkIn' => '08:30 AM', 'checkOut' => '05:30 PM', 'late' => 0, 'earlyExit' => 30, 'overtime' => 0],
            ['date' => 'Mar 07, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 08, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 09, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:10 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 10, 2026', 'status' => 'Present', 'checkIn' => '08:45 AM', 'checkOut' => '07:00 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 1.5],
            ['date' => 'Mar 11, 2026', 'status' => 'Present', 'checkIn' => '09:20 AM', 'checkOut' => '06:15 PM', 'late' => 20, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 12, 2026', 'status' => 'Present', 'checkIn' => '08:50 AM', 'checkOut' => '05:45 PM', 'late' => 0, 'earlyExit' => 15, 'overtime' => 0],
            ['date' => 'Mar 13, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:30 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 1.0],
            ['date' => 'Mar 14, 2026', 'status' => 'Present', 'checkIn' => '09:10 AM', 'checkOut' => '06:20 PM', 'late' => 10, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 15, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 16, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 17, 2026', 'status' => 'Present', 'checkIn' => '08:40 AM', 'checkOut' => '06:45 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 2.0],
            ['date' => 'Mar 18, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:00 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 19, 2026', 'status' => 'Present', 'checkIn' => '09:00 AM', 'checkOut' => '06:05 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 20, 2026', 'status' => 'Present', 'checkIn' => '08:50 AM', 'checkOut' => '05:50 PM', 'late' => 0, 'earlyExit' => 10, 'overtime' => 0],
            ['date' => 'Mar 21, 2026', 'status' => 'Present', 'checkIn' => '08:45 AM', 'checkOut' => '06:15 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 22, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 23, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 24, 2026', 'status' => 'Present', 'checkIn' => '09:05 AM', 'checkOut' => '06:10 PM', 'late' => 5, 'earlyExit' => 0, 'overtime' => 0.5],
            ['date' => 'Mar 25, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:30 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 1.0],
            ['date' => 'Mar 26, 2026', 'status' => 'Absent', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 27, 2026', 'status' => 'Present', 'checkIn' => '08:50 AM', 'checkOut' => '07:00 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 1.5],
            ['date' => 'Mar 28, 2026', 'status' => 'Present', 'checkIn' => '08:45 AM', 'checkOut' => '05:45 PM', 'late' => 0, 'earlyExit' => 15, 'overtime' => 0],
            ['date' => 'Mar 29, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 30, 2026', 'status' => 'Weekend', 'checkIn' => '-', 'checkOut' => '-', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
            ['date' => 'Mar 31, 2026', 'status' => 'Present', 'checkIn' => '08:55 AM', 'checkOut' => '06:00 PM', 'late' => 0, 'earlyExit' => 0, 'overtime' => 0],
        ];

        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyEmail' => 'hr@abccorporation.com',
            'companyAddress' => '123 Business Avenue, Suite 100, New York, NY 10001',
            'currency' => '$',
            'attendanceEmail' => 'attendance@abccorporation.com',

            // Employee Information
            'employeeName' => 'Sarah Johnson',
            'employeeId' => 'EMP-2026-0234',
            'department' => 'Software Development',
            'designation' => 'Senior Developer',

            // Month Information
            'month' => 'March',
            'year' => '2026',

            // Attendance Summary (Your specified parameters)
            'attendanceRecords' => $attendanceRecords,
            'presentDays' => 22,
            'absentDays' => 1,
            'totalWorkingDays' => 23,
            'totalLateMinutes' => 55,
            'totalEarlyExitMinutes' => 70,
            'totalOvertimeHours' => 12.5,
            'overtimeRate' => '1.5x',
            'overtimePay' => 375.00,

            // Additional Information
            'attendancePortalUrl' => 'https://portal.abccorporation.com/attendance',
            'reportGeneratedDate' => now()->format('F d, Y'),
        ];

        return view('emails.attendance', $data);
    }

    public function sendMonthlyAttendanceEmail(Request $request)
    {
        $request->validate([
            'employee_email' => 'required|email',
            'employee_name' => 'required|string',
            'employee_id' => 'required|string',
            'month' => 'required|string',
            'year' => 'required|string',
            'present_days' => 'required|integer',
            'absent_days' => 'required|integer',
            'total_late_minutes' => 'required|integer',
            'total_early_exit_minutes' => 'required|integer',
            'total_overtime_hours' => 'required|numeric',
        ]);

        $emailData = [
            // Company Information
            'companyName' => $request->company_name ?? 'ABC Corporation',
            'companyEmail' => $request->company_email ?? 'hr@company.com',
            'companyAddress' => $request->company_address ?? '123 Business Avenue, City, State',
            'currency' => $request->currency ?? '$',
            'attendanceEmail' => $request->attendance_email ?? 'attendance@company.com',

            // Employee Information
            'employeeName' => $request->employee_name,
            'employeeId' => $request->employee_id,
            'department' => $request->department ?? 'Not Specified',
            'designation' => $request->designation ?? 'Employee',

            // Month Information
            'month' => $request->month,
            'year' => $request->year,

            // Attendance Records (would typically come from database)
            'attendanceRecords' => $request->attendance_records ?? [],

            // Attendance Summary
            'presentDays' => $request->present_days,
            'absentDays' => $request->absent_days,
            'totalWorkingDays' => $request->present_days + $request->absent_days,
            'totalLateMinutes' => $request->total_late_minutes,
            'totalEarlyExitMinutes' => $request->total_early_exit_minutes,
            'totalOvertimeHours' => $request->total_overtime_hours,
            'overtimeRate' => $request->overtime_rate ?? '1.5x',
            'overtimePay' => $request->overtime_pay ?? ($request->total_overtime_hours * 30),

            // Additional Information
            'attendancePortalUrl' => $request->attendance_portal_url ?? 'https://portal.company.com/attendance',
            'reportGeneratedDate' => now()->format('F d, Y'),
        ];

        // Uncomment this when you have the mail class ready
        // Mail::to($request->employee_email)->send(new MonthlyAttendanceMail($emailData));

        return response()->json([
            'success' => true,
            'message' => 'Monthly attendance email sent successfully!',
            'data' => $emailData
        ]);
    }

    public function noticeEmail()
    {
        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyEmail' => 'communications@abccorporation.com',
            'companyAddress' => '123 Business Avenue, Suite 100, New York, NY 10001',

            // Notice Information
            'type' => 'general', // general, event, urgent
            'title' => 'Office Closure for Maintenance',
            'subtitle' => 'Important announcement regarding facility maintenance',
            'employeeName' => 'All Employees',
            'message' => 'We would like to inform you about the upcoming office maintenance scheduled for this weekend.',
            'content' => '<p>The office will be closed for <strong>essential maintenance work</strong> on the following dates:</p>
                         <ul style="margin-top: 10px; margin-bottom: 10px; padding-left: 20px;">
                            <li>Saturday, March 15, 2026 (8:00 AM - 8:00 PM)</li>
                            <li>Sunday, March 16, 2026 (8:00 AM - 6:00 PM)</li>
                         </ul>
                         <p>During this time, access to the building will be restricted. Please plan your work accordingly.</p>',

            // Highlights
            'highlights' => [
                'All employees must vacate by 7:00 PM on Friday',
                'IT systems will remain accessible remotely',
                'Emergency access available through security desk'
            ],

            // Important Dates
            'importantDates' => [
                ['date' => 'March 14, 2026', 'description' => 'Last day for office access before maintenance'],
                ['date' => 'March 17, 2026', 'description' => 'Office reopens for normal operations']
            ],

            // Attachments
            'attachments' => [
                ['name' => 'Maintenance_Schedule.pdf', 'url' => '#', 'size' => '245 KB'],
                ['name' => 'Remote_Access_Guide.pdf', 'url' => '#', 'size' => '180 KB']
            ],

            // CTA
            'ctaText' => 'View Full Schedule',
            'ctaUrl' => '#',

            // Contact Information
            'contactPerson' => 'Facilities Department',
            'contactTitle' => 'Building Management',
            'contactEmail' => 'facilities@abccorporation.com',
            'contactPhone' => '+1 (555) 123-4567',
        ];

        return view('emails.notice', $data);
    }

    /**
     * Display the event announcement email template
     */
    public function eventEmail()
    {
        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyEmail' => 'events@abccorporation.com',
            'companyAddress' => '123 Business Avenue, Suite 100, New York, NY 10001',

            // Event Information
            'type' => 'event',
            'title' => 'Annual Company Picnic 2026',
            'subtitle' => 'Join us for a day of fun and celebration!',
            'employeeName' => 'All Employees',
            'message' => 'We are excited to announce our Annual Company Picnic! Get ready for a day filled with fun activities, delicious food, and great company.',
            'content' => '<p>Bring your family and join us for:</p>
                         <ul style="margin-top: 10px; margin-bottom: 10px; padding-left: 20px;">
                            <li>🏐 Sports tournaments</li>
                            <li>🎮 Games and activities</li>
                            <li>🍔 BBQ lunch</li>
                            <li>🎁 Raffle prizes</li>
                            <li>🏆 Employee recognition awards</li>
                         </ul>',

            // Event Details
            'eventDate' => 'Saturday, April 26, 2026',
            'eventTime' => '11:00 AM - 5:00 PM',
            'eventLocation' => 'Riverside Park, Shelter #3, 123 Park Avenue',
            'rsvpRequired' => true,
            'rsvpDeadline' => 'April 15, 2026',

            // Highlights
            'highlights' => [
                'Free for employees and immediate family',
                'Transportation provided from office',
                'Vegetarian and special diet options available',
                'Kids zone with supervised activities'
            ],

            // Attachments
            'attachments' => [
                ['name' => 'Event_Schedule.pdf', 'url' => '#', 'size' => '320 KB'],
                ['name' => 'RSVP_Form.docx', 'url' => '#', 'size' => '95 KB']
            ],

            // CTA
            'ctaText' => 'RSVP Now',
            'ctaUrl' => '#',

            // Contact Information
            'contactPerson' => 'Events Committee',
            'contactTitle' => 'Employee Engagement',
            'contactEmail' => 'events@abccorporation.com',
            'contactPhone' => '+1 (555) 987-6543',
        ];

        return view('emails.notice', $data);
    }

    /**
     * Display the urgent notice email template
     */
    public function urgentNoticeEmail()
    {
        $data = [
            // Company Information
            'companyName' => 'ABC Corporation',
            'companyEmail' => 'hr@abccorporation.com',
            'companyAddress' => '123 Business Avenue, Suite 100, New York, NY 10001',

            // Urgent Notice Information
            'type' => 'urgent',
            'title' => 'URGENT: System Maintenance',
            'subtitle' => 'Critical updates to company systems',
            'employeeName' => 'All Employees',
            'message' => 'Important notice regarding scheduled system maintenance that will affect all employees.',
            'content' => '<p>The IT department will be performing <strong>critical system updates</strong> that require all systems to be offline temporarily.</p>
                         <p><strong>Impact:</strong> All company systems including email, HR portal, and file servers will be unavailable.</p>',

            // Urgent Details
            'actionRequired' => 'Please save all your work and log out of all systems by 5:00 PM today. Systems will be unavailable from 6:00 PM today until 8:00 AM tomorrow.',

            // Important Dates
            'importantDates' => [
                ['date' => 'Today, 5:00 PM', 'description' => 'Deadline to save work and logout'],
                ['date' => 'Today, 6:00 PM', 'description' => 'Systems go offline'],
                ['date' => 'Tomorrow, 8:00 AM', 'description' => 'Systems expected to be back online']
            ],

            // Attachments
            'attachments' => [
                ['name' => 'Data_Backup_Instructions.pdf', 'url' => '#', 'size' => '156 KB']
            ],

            // CTA
            'ctaText' => 'View Maintenance Details',
            'ctaUrl' => '#',

            // Contact Information
            'contactPerson' => 'IT Help Desk',
            'contactTitle' => '24/7 Support',
            'contactEmail' => 'itsupport@abccorporation.com',
            'contactPhone' => '+1 (555) 111-2222',
        ];

        return view('emails.notice', $data);
    }

}
