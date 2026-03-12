<?php

use App\Livewire\Auth\Login;
use App\Livewire\Employ\Attendance;
use App\Livewire\Employ\Complain\ComplainForm;
use App\Livewire\Employ\Complain\ComplainManagement;
use App\Livewire\Employ\Dashboard;
use App\Livewire\Employ\Leave\LeaveForm;
use App\Livewire\Employ\Leave\LeaveManagement;
use App\Livewire\Employ\Loan\LoanForm;
use App\Livewire\Employ\Loan\LoanManagement;
use App\Livewire\Employ\Loan\ViewLoan;
use App\Livewire\Employ\Notice;
use App\Livewire\Employ\PaySlips;
use App\Livewire\Employ\Profile;
use App\Livewire\Employ\ViewNotice;
use App\Livewire\Employ\PayslipDetails;
use App\Livewire\Employ\Resignation\CreateApplication;
use App\Livewire\Employ\Resignation\ManageResignation;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');

Route::middleware('employee')->prefix('employee')->name('employee.')->group(function () {
    Route::livewire('dashboard', Dashboard::class)
        ->name('dashboard');
    Route::livewire('attendance', Attendance::class)
        ->name('attendance');
    Route::livewire('leave', LeaveManagement::class)
        ->name('leave');
    Route::livewire('leave/apply', LeaveForm::class)
        ->name('leave.create');
    Route::livewire('payslips', PaySlips::class)
        ->name('payslips');
    Route::livewire('payslips/{payslip}', PayslipDetails::class)
        ->name('payslips.show');
    Route::livewire('notices', Notice::class)
        ->name('notices');
    Route::livewire('notices/{notice}', ViewNotice::class)
        ->name('notices.view');
    Route::livewire('complain/management', ComplainManagement::class)
        ->name('complain');
    Route::livewire('complain/create', ComplainForm::class)
        ->name('complain.create');
    Route::livewire('loan/management', LoanManagement::class)
        ->name('loan');
    Route::livewire('loan/apply', LoanForm::class)
        ->name('loan.create');
    Route::livewire('loan/{loan}', ViewLoan::class)
        ->name('loan.show');
    Route::livewire('profile', Profile::class)
        ->name('profile');

        // Resignation Management
    Route::prefix('resignations')->name('resignations.')->group(function () {
        Route::livewire('/', ManageResignation::class)
            ->name('index');
        Route::livewire('/details/{resignation}', ManageResignation::class)
            ->name('details');
        Route::livewire('/create/', CreateApplication::class)
            ->name('create');
    });
});
