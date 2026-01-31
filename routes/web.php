<?php

use App\Livewire\Admin\Branch\BranchForm;
use App\Livewire\Admin\Branch\BranchManagement;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Department\DepartmentForm;
use App\Livewire\Admin\Department\DepartmentManagement;
use App\Livewire\Admin\Designation\DesignationForm;
use App\Livewire\Admin\Designation\DesignationManagement;
use App\Livewire\Admin\Roster\RosterForm;
use App\Livewire\Admin\Roster\RosterManagement;
use App\Livewire\Admin\Shift\ShiftForm;
use App\Livewire\Admin\Shift\ShiftManagement;
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
});
