<?php

namespace App\Providers;

use App\Models\{Attendance, Employee, Expense, Leave, Loan, LoanInstallment, Payroll, RosterEmployee, Transfer, Notice, Complain,Roster,};

use App\Observers\AuditObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helper/ImageHelper.php');
        require_once app_path('Helper/MainHelper.php');

        $auditableModels = [
            Employee::class,
            Attendance::class,
            Leave::class,
            Payroll::class,
            Loan::class,
            LoanInstallment::class,
            Transfer::class,
            Expense::class,
            Notice::class,
            Complain::class,
            Roster::class,
            RosterEmployee::class,
        ];

        foreach ($auditableModels as $modelClass) {
            if (class_exists($modelClass)) {
                $modelClass::observe(AuditObserver::class);
            }
        }
    }
}
