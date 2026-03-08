<?php

use App\Http\Controllers\AdmsController;
use App\Http\Controllers\StorageFileDownloader;
use App\Livewire\Admin\Attendance\AddManualAttendance;
use App\Livewire\Admin\Attendance\AttendanceList;
use App\Livewire\Admin\AttendancePolicy\AttendancePolicyAdd;
use App\Livewire\Admin\AttendancePolicy\AttendancePolicyList;
use App\Livewire\Admin\Branch\BranchForm;
use App\Livewire\Admin\Branch\BranchManagement;
use App\Livewire\Admin\Calender;
use App\Livewire\Admin\Complain\ComplainAdd;
use App\Livewire\Admin\Complain\ComplainList;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Department\DepartmentForm;
use App\Livewire\Admin\Department\DepartmentManagement;
use App\Livewire\Admin\Designation\DesignationForm;
use App\Livewire\Admin\Designation\DesignationManagement;
use App\Livewire\Admin\Employees\EmployeeAdd;
use App\Livewire\Admin\Employees\EmployeeDetails;
use App\Livewire\Admin\Employees\EmployeeList;
use App\Livewire\Admin\Expense\ExpenseDetails;
use App\Livewire\Admin\Expense\ExpenseManagement;
use App\Livewire\Admin\Expense\ExpenseTypeManagement;
use App\Livewire\Admin\Holiday\HolidayAdd;
use App\Livewire\Admin\Holiday\HolidayList;
use App\Livewire\Admin\Leavemgt\LeaveApplication;
use App\Livewire\Admin\Leavemgt\LeaveList;
use App\Livewire\Admin\Leavemgt\LeaveType;
use App\Livewire\Admin\Loan\LoanCreate;
use App\Livewire\Admin\Loan\LoanDetails;
use App\Livewire\Admin\Loan\LoanList;
use App\Livewire\Admin\Notice\ManageNotice;
use App\Livewire\Admin\Notice\NoticeDetails;
use App\Livewire\Admin\Notice\NoticeForm;
use App\Livewire\Admin\PayrollAdjustment\AdjustmentAdditionDeduction;
use App\Livewire\Admin\PayrollAdjustment\AdjustmentAdditionDeductionNew;
use App\Livewire\Admin\Payroll\ExportPayRoll;
use App\Livewire\Admin\Payroll\PayrollEngine;
use App\Livewire\Admin\Payroll\PayrollList;
use App\Livewire\Admin\PaySlips\PaySlipManagement;
use App\Livewire\Admin\PaySlips\PaySlipsDetails;
use App\Livewire\Admin\Profile\ManageProfile;
use App\Livewire\Admin\Reports\AttendanceReport;
use App\Livewire\Admin\Reports\ExpenseReport;
use App\Livewire\Admin\Reports\LeaveReport;
use App\Livewire\Admin\Reports\PayslipReport;
use App\Livewire\Admin\RolesPermission\ActivityLog;
use App\Livewire\Admin\RolesPermission\ManageUser;
use App\Livewire\Admin\RolesPermission\UserForm;
use App\Livewire\Admin\Roster\RosterForm;
use App\Livewire\Admin\Roster\RosterManagement;
use App\Livewire\Admin\Shift\ShiftForm;
use App\Livewire\Admin\Shift\ShiftManagement;
use App\Livewire\Admin\Transfer\TransferList;
use App\Livewire\Admin\Transfer\TransferNew;
use App\Livewire\Auth\AdminLogin;
use App\Livewire\Admin\SettingManagement;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SalaryReportController;
use App\Livewire\Admin\RolesPermission\Roles\ManageRoles;
use App\Livewire\Admin\RolesPermission\Roles\RolesForm;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/admin/login', AdminLogin::class)->name('admin.login');

Route::get('/create/storage', function () {
    Artisan::call('storage:link');
});

// Route to view the leave approval email template
Route::get('/email/leave-approval', [EmailController::class, 'leaveApprovalEmail'])->name('emails.leave');
Route::post('/email/leave-approval/send', [EmailController::class, 'sendLeaveApprovalEmail'])->name('emails.leave.send');
Route::get('/email/payslip', [EmailController::class, 'payslipEmail'])->name('emails.payslip');
Route::post('/email/payslip/send', [EmailController::class, 'sendPayslipEmail'])->name('emails.payslip.send');
Route::get('/email/employee-credentials', [EmailController::class, 'employeeCredentialsEmail'])->name('email.employee-credentials');
Route::post('/email/send-employee-credentials', [EmailController::class, 'sendEmployeeCredentialsEmail'])->name('email.send-employee-credentials');
Route::get('/email/loan-management', [EmailController::class, 'loanManagementEmail'])->name('email.loan-management');
Route::post('/email/send-loan-management', [EmailController::class, 'sendLoanManagementEmail'])->name('email.send-loan-management');
Route::get('/email/monthly-attendance', [EmailController::class, 'monthlyAttendanceEmail'])->name('email.monthly-attendance');
Route::post('/email/send-monthly-attendance', [EmailController::class, 'sendMonthlyAttendanceEmail'])->name('email.send-monthly-attendance');
Route::get('/email/notice/general', [EmailController::class, 'noticeEmail'])->name('email.notice.general');
Route::get('/email/notice/event', [EmailController::class, 'eventEmail'])->name('email.notice.event');
Route::get('/email/notice/urgent', [EmailController::class, 'urgentNoticeEmail'])->name('email.notice.urgent');
Route::post('/email/send-notice', [EmailController::class, 'sendNoticeEmail'])->name('email.send-notice');

Route::get('/salary-report', [SalaryReportController::class, 'index'])->name('salary.report');
Route::get('/salary-report/pdf', [SalaryReportController::class, 'generatePDF'])->name('salary.pdf');
Route::get('/salary-report/print', [SalaryReportController::class, 'print'])->name('salary.print');

Route::get('admin/logout', function () {
    Auth::logout();
    return redirect()->route('admin.login');
})->name('admin.logout');

Route::get('/employee/logout', function () {
    Auth::guard('employee')->logout();
    return redirect()->route('login');
})->name('employee.logout');

Route::get('/download/{filePath}', [StorageFileDownloader::class, 'download'])
    ->where('filePath', '.*')
    ->name('file.download');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::livewire('dashboard', Dashboard::class)
        ->name('dashboard')->middleware('permission:dashboard.show');

    // Branch Management
    Route::prefix('branches')->name('branches.')->group(function () {
        Route::livewire('/', BranchManagement::class)
            ->name('index')->middleware('permission:branches.show');
        Route::livewire('/create', BranchForm::class)
            ->name('create')->middleware('permission:branches.create');
        Route::livewire('/edit/{branch}', BranchForm::class)
            ->name('edit')->middleware('permission:branches.edit');
    });

    // Department Management
    Route::prefix('departments')->name('departments.')->group(function () {
        Route::livewire('/', DepartmentManagement::class)
            ->name('index')->middleware('permission:departments.show');
        Route::livewire('/create', DepartmentForm::class)
            ->name('create')->middleware('permission:departments.create');
        Route::livewire('/edit/{department}', DepartmentForm::class)
            ->name('edit')->middleware('permission:departments.edit');
    });

    // Shift Management
    Route::prefix('shifts')->name('shifts.')->group(function () {
        Route::livewire('/', ShiftManagement::class)
            ->name('index')->middleware('permission:shifts.show');
        Route::livewire('/create', ShiftForm::class)
            ->name('create')->middleware('permission:shifts.create');
        Route::livewire('/edit/{shift}', ShiftForm::class)
            ->name('edit')->middleware('permission:shifts.edit');
    });

    // Roster Management
    Route::prefix('rosters')->name('rosters.')->group(function () {
        Route::livewire('/', RosterManagement::class)
            ->name('index')->middleware('permission:rosters.show');
        Route::livewire('/create', RosterForm::class)
            ->name('create')->middleware('permission:rosters.create');
        Route::livewire('/edit/{roster}', RosterForm::class)
            ->name('edit')->middleware('permission:rosters.edit');
    });
    // Designation Management
    Route::prefix('designations')->name('designations.')->group(function () {
        Route::livewire('/', DesignationManagement::class)
            ->name('index')->middleware('permission:designations.show');
        Route::livewire('/create', DesignationForm::class)
            ->name('create')->middleware('permission:designations.create');
        Route::livewire('/edit/{designation}', DesignationForm::class)
            ->name('edit')->middleware('permission:designations.edit');
    });

    // Leave Management
    Route::prefix('leavemgt')->name('leavemgt.')->group(function () {
        Route::livewire('/leave/types', LeaveType::class)
            ->name('leave.types')->middleware('permission:leave-types.show');
        Route::livewire('/leave/list', LeaveList::class)
            ->name('leave.list')->middleware('permission:leave-list.show');
        Route::livewire('/leave/application', LeaveApplication::class)
            ->name('leave.application')->middleware('permission:leave-application.show');

    });

    // Employee Management
    Route::prefix('employees')->name('employees.')->group(function () {
        Route::livewire('/', EmployeeList::class)
            ->name('index')->middleware('permission:employees.show');
        Route::livewire('/create', EmployeeAdd::class)
            ->name('create')->middleware('permission:employees.create');
        Route::livewire('/edit/{emp}', EmployeeAdd::class)
            ->name('edit')->middleware('permission:employees.edit');
        Route::livewire('/details/{emp}', EmployeeDetails::class)
            ->name('details')->middleware('permission:employees.show');
        
    });

    // Attendance Management
    Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::livewire('/', AttendanceList::class)
            ->name('index')->middleware('permission:attendance.show');
        Route::livewire('/add/manual', AddManualAttendance::class)
            ->name('add.manual')->middleware('permission:attendance.add');
    });

    // Attendance Management
    Route::prefix('transfer')->name('transfer.')->group(function () {
        Route::livewire('/', TransferList::class)
            ->name('index')->middleware('permission:transfer.show');
        Route::livewire('/new/transfer', TransferNew::class)
            ->name('new')->middleware('permission:transfer.create');

        Route::livewire('/new/transfer/{transferid}', TransferNew::class)
            ->name('edit')->middleware('permission:transfer.edit');

    });

    // Payroll Adjustment Management
    Route::prefix('adjustment')->name('adjustment.')->group(function () {
        Route::livewire('/', AdjustmentAdditionDeduction::class)
            ->name('index')->middleware('permission:adjustment.show');
        Route::livewire('/adjustment/new', AdjustmentAdditionDeductionNew::class)
            ->name('new')->middleware('permission:adjustment.create');

        Route::livewire('/adjustment/edit/{adjustment}', AdjustmentAdditionDeductionNew::class)
            ->name('edit')->middleware('permission:adjustment.edit');

    });
    // Loan Management
    Route::prefix('loan')->name('loan.')->group(function () {
        Route::livewire('/', LoanList::class)
            ->name('index')->middleware('permission:loan.show');
        Route::livewire('/create', LoanCreate::class)
            ->name('new')->middleware('permission:loan.create');

        Route::livewire('/adjustment/details/{loan}', LoanDetails::class)
            ->name('show')->middleware('permission:loan.show');

    });
    // Calendar Management
    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::livewire('/', Calender::class)
            ->name('index');
    });

    // Payroll Engine
    Route::prefix('payroll')->name('payroll.')->group(function () {
        Route::livewire('/', PayrollEngine::class)
            ->name('index')->middleware('permission:payroll.show');
        Route::livewire('/payroll/list', PayrollList::class)
            ->name('list')->middleware('permission:payroll.list.show');

        Route::livewire('/payroll/export/{payrolls}', ExportPayRoll::class)
            ->name('export')->middleware('permission:payroll.export.show');

        Route::livewire('/adjustment/details/{loan}', LoanDetails::class)
            ->name('show')->middleware('permission:payroll.show');
        Route::livewire('/payslips', PaySlipManagement::class)
            ->name('payslips')->middleware('permission:payroll.show');
        Route::livewire('/payslips/{payslip}', PaySlipsDetails::class)
            ->name('payslips.show')->middleware('permission:payroll.show');
    });
    // Complaint Management
    Route::prefix('complain')->name('complain.')->group(function () {
        Route::livewire('/', ComplainList::class)
            ->name('index')->middleware('permission:complains.show');
        Route::livewire('/add', ComplainAdd::class)
            ->name('new')->middleware('permission:complains.add');
        Route::livewire('/complain/edit/{complainId}', ComplainAdd::class)
            ->name('edit')->middleware('permission:complains.edit');

    });
    
    Route::prefix('notices')->name('notice.')->group(function () {
        Route::livewire('/', ManageNotice::class)
            ->name('index')->middleware('permission:notices.show');
        Route::livewire('/create', NoticeForm::class)
            ->name('create')->middleware('permission:notices.create');

        Route::livewire('/edit/{notice}', NoticeForm::class)
            ->name('edit')->middleware('permission:notices.edit');
        Route::livewire('/details/{notice}', NoticeDetails::class)
            ->name('show')->middleware('permission:notices.show');

    });
    Route::prefix('expenses')->name('expenses.')->group(function () {
        Route::livewire('/type', ExpenseTypeManagement::class)
            ->name('type')->middleware('permission:expenses.type.show');
        Route::livewire('/management', ExpenseManagement::class)
            ->name('index')->middleware('permission:expenses.show');
        Route::livewire('/{expense}', ExpenseDetails::class)
            ->name('show')->middleware('permission:expenses.show');
    });

    // Holiday Management
    Route::prefix('holiday')->name('holiday.')->group(function () {
        Route::livewire('/', HolidayList::class)
            ->name('index')->middleware('permission:holiday.show');
        Route::livewire('/add/holiday', HolidayAdd::class)
            ->name('add')->middleware('permission:holiday.add');

    });

    // Attendance Policy Management
    Route::prefix('attendance-policy')->name('attendance-policy.')->group(function () {
        Route::livewire('/', AttendancePolicyList::class)
            ->name('index')->middleware('permission:attendance-policy.show');
        Route::livewire('/add', AttendancePolicyAdd::class)
            ->name('add')->middleware('permission:attendance-policy.add');
        Route::livewire('/attendance/edit/{policyID}', AttendancePolicyAdd::class)
            ->name('edit')->middleware('permission:attendance-policy.edit');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::livewire('/attendance', AttendanceReport::class)
            ->name('attendance')->middleware('permission:reports.attendance.show');
        Route::livewire('/leave', LeaveReport::class)
            ->name('leave')->middleware('permission:reports.leave.show');
        Route::livewire('/payslips', PayslipReport::class)
            ->name('payslips')->middleware('permission:reports.payslips.show');
        Route::livewire('/expense', ExpenseReport::class)
            ->name('expense')->middleware('permission:reports.expense.show');
    });

    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::livewire('/', SettingManagement::class)
            ->name('index')->middleware('permission:settings.show');
    });

    // Profile
    Route::livewire('/profile', ManageProfile::class)
            ->name('profile')->middleware('permission:profile.show');

    // Roles and Permissions
   Route::livewire('/users',ManageUser::class)
            ->name('users')->middleware('permission:users.show');
   Route::livewire('/user/create',UserForm::class)
            ->name('user.create')->middleware('permission:users.create');
   Route::livewire('/user/edit/{user}',UserForm::class)
            ->name('user.edit')->middleware('permission:users.edit');

    Route::livewire('/roles', ManageRoles::class)
            ->name('roles')->middleware('permission:roles.show');

    Route::livewire('/role/create', RolesForm::class)
            ->name('role.create')->middleware('permission:roles.create');
    Route::livewire('/role/edit/{role}', RolesForm::class)
            ->name('role.edit')->middleware('permission:roles.edit');
            
    // Activity Log
    Route::livewire('/activity-log', ActivityLog::class)
        ->name('activity-log')->middleware('permission:activity-log.show');

    Route::any('/mobile/get/data', [AdmsController::class,'receive'])->where('any', '.*');
    Route::any('/mobile/get/request', [AdmsController::class,'getRequest'])->where('any', '.*');

});
