<?php

use App\Livewire\Admin\Dashboard;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin.')->group(function () {
    Route::livewire('dashboard', Dashboard::class)
        ->name('dashboard');
});
