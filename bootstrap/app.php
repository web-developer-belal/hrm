<?php

use App\Http\Middleware\AdminPermissionMiddleware;
use App\Http\Middleware\EmployeeMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')->group(base_path('routes/employee.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
       $middleware->alias([
        'employee' => EmployeeMiddleware::class,
        'permission' => AdminPermissionMiddleware::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
