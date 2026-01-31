<?php

use App\Livewire\Admin\Branch\BranchForm;
use App\Livewire\Admin\Branch\BranchManagement;
use App\Livewire\Admin\Dashboard;
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

    
});
