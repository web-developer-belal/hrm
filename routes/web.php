<?php

use App\Livewire\Admin\Attendance\AddManualAttendance;
use App\Livewire\Admin\Attendance\AttendanceList;
use App\Livewire\Admin\Branch\BranchForm;
use App\Livewire\Admin\Branch\BranchManagement;
use App\Livewire\Admin\Complain\ComplainAdd;
use App\Livewire\Admin\Complain\ComplainList;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Department\DepartmentForm;
use App\Livewire\Admin\Department\DepartmentManagement;
use App\Livewire\Admin\Designation\DesignationForm;
use App\Livewire\Admin\Designation\DesignationManagement;
use App\Livewire\Admin\Device\DeviceSync;
use App\Livewire\Admin\Employees\EmployeeAdd;
use App\Livewire\Admin\Employees\EmployeeDetails;
use App\Livewire\Admin\Employees\EmployeeList;
use App\Livewire\Admin\Leavemgt\LeaveApplication;
use App\Livewire\Admin\Leavemgt\LeaveList;
use App\Livewire\Admin\Leavemgt\LeaveType;
use App\Livewire\Admin\Loan\LoanCreate;
use App\Livewire\Admin\Loan\LoanDetails;
use App\Livewire\Admin\Loan\LoanList;
use App\Livewire\Admin\Payroll\PayrollEngine;
use App\Livewire\Admin\Payroll\PayrollList;
use App\Livewire\Admin\PayrollAdjustment\AdjustmentAdditionDeduction;
use App\Livewire\Admin\PayrollAdjustment\AdjustmentAdditionDeductionNew;
use App\Livewire\Admin\Roster\RosterForm;
use App\Livewire\Admin\Roster\RosterManagement;
use App\Livewire\Admin\Shift\ShiftForm;
use App\Livewire\Admin\Shift\ShiftManagement;
use App\Livewire\Admin\Transfer\TransferList;
use App\Livewire\Admin\Transfer\TransferNew;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::livewire('dashboard', Dashboard::class)
        ->name('dashboard');

    // Branch Management
    Route::prefix('branches')->name('branches.')->group(function () {
        Route::livewire('/', BranchManagement::class)
            ->name('index');
        Route::livewire('/create', BranchForm::class)
            ->name('create');
        Route::livewire('/edit/{branch}', BranchForm::class)
            ->name('edit');
    });

    // Department Management
    Route::prefix('departments')->name('departments.')->group(function () {
        Route::livewire('/', DepartmentManagement::class)
            ->name('index');
        Route::livewire('/create', DepartmentForm::class)
            ->name('create');
        Route::livewire('/edit/{department}', DepartmentForm::class)
            ->name('edit');
    });

    // Shift Management
    Route::prefix('shifts')->name('shifts.')->group(function () {
        Route::livewire('/', ShiftManagement::class)
            ->name('index');
        Route::livewire('/create', ShiftForm::class)
            ->name('create');
        Route::livewire('/edit/{shift}', ShiftForm::class)
            ->name('edit');
    });

    // Roster Management
    Route::prefix('rosters')->name('rosters.')->group(function () {
        Route::livewire('/', RosterManagement::class)
            ->name('index');
        Route::livewire('/create', RosterForm::class)
            ->name('create');
        Route::livewire('/edit/{roster}', RosterForm::class)
            ->name('edit');
    });
    // Designation Management
    Route::prefix('designations')->name('designations.')->group(function () {
        Route::livewire('/', DesignationManagement::class)
            ->name('index');
        Route::livewire('/create', DesignationForm::class)
            ->name('create');
        Route::livewire('/edit/{designation}', DesignationForm::class)
            ->name('edit');
    });

  // Leave Management
    Route::prefix('leavemgt')->name('leavemgt.')->group(function () {
        Route::livewire('/leave/typess', LeaveType::class)
            ->name('leave.types');
        Route::livewire('/leave/list', LeaveList::class)
            ->name('leave.list');
        Route::livewire('/leave/application', LeaveApplication::class)
            ->name('leave.application');

    });


     // Employee Management
     Route::prefix('employees')->name('employees.')->group(function () {
        Route::livewire('/', EmployeeList::class)
            ->name('index');
        Route::livewire('/create', EmployeeAdd::class)
            ->name('create');
        Route::livewire('/edit/{emp}', EmployeeAdd::class)
            ->name('edit');
        Route::livewire('/details/{emp}', EmployeeDetails::class)
            ->name('details');
    });

     // Attendance Management
     Route::prefix('attendance')->name('attendance.')->group(function () {
        Route::livewire('/', AttendanceList::class)
            ->name('index');
        Route::livewire('/add/mannual', AddManualAttendance::class)
            ->name('add.mannual');
        Route::livewire('/edit/{emp}', EmployeeAdd::class)
            ->name('edit');
    });

         // Attendance Management
     Route::prefix('transfer')->name('transfer.')->group(function () {
        Route::livewire('/', TransferList::class)
            ->name('index');
        Route::livewire('/new/transfer', TransferNew::class)
            ->name('new');

         Route::livewire('/new/transfe/{transferid}', TransferNew::class)
            ->name('edit');

    });

           // Payroll Adjustment Management
           Route::prefix('adjustment')->name('adjustment.')->group(function () {
            Route::livewire('/', AdjustmentAdditionDeduction::class)
                ->name('index');
            Route::livewire('/adjustment/new', AdjustmentAdditionDeductionNew::class)
                ->name('new');

             Route::livewire('/adjustment/edit/{adjustment}', AdjustmentAdditionDeductionNew::class)
                ->name('edit');

        });
           // Loan Management
           Route::prefix('loan')->name('loan.')->group(function () {
            Route::livewire('/', LoanList::class)
                ->name('index');
            Route::livewire('/create', LoanCreate::class)
                ->name('new');

             Route::livewire('/adjustment/details/{loan}', LoanDetails::class)
                ->name('show');

        });

           // Payroll Engine
           Route::prefix('payroll')->name('payroll.')->group(function () {
            Route::livewire('/', PayrollEngine::class)
                ->name('index');
            Route::livewire('/payroll/list', PayrollList::class)
                ->name('payroll.list');

             Route::livewire('/adjustment/details/{loan}', LoanDetails::class)
                ->name('show');

        });
           // Complaint Management
           Route::prefix('complain')->name('complain.')->group(function () {
            Route::livewire('/', ComplainList::class)
                ->name('index');
            Route::livewire('/add', ComplainAdd::class)
                ->name('new');
            Route::livewire('/complain/edit/{complainId}', ComplainAdd::class)
                ->name('edit');

        });
           // Device Management
           Route::prefix('device')->name('device.')->group(function () {
            Route::livewire('/', DeviceSync::class)
                ->name('index');
            Route::livewire('/add', ComplainAdd::class)
                ->name('new');


        });


});
