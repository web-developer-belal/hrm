<?php

use App\Livewire\Auth\Login;
use App\Livewire\Employ\Attendance;
use App\Livewire\Employ\Dashboard;
use App\Livewire\Employ\Leave;
use App\Livewire\Employ\Notice;
use App\Livewire\Employ\PaySlips;
use App\Livewire\Employ\Profile;
use App\Livewire\Employ\ViewNotice;
use Illuminate\Support\Facades\Route;

Route::get('/', Login::class)->name('login');

Route::middleware('employee')->prefix('employee')->name('employee.')->group(function () {
    Route::livewire('dashboard', Dashboard::class)
        ->name('dashboard');
    Route::livewire('attendance', Attendance::class)
        ->name('attendance');
    Route::livewire('leave', Leave::class)
        ->name('leave');
    Route::livewire('profile', Profile::class)
        ->name('profile');
    Route::livewire('payslips', PaySlips::class)
        ->name('payslips');
    Route::livewire('notices', Notice::class)
        ->name('notices');
    Route::livewire('notices/{notice}', ViewNotice::class)
        ->name('notices.view');
});
