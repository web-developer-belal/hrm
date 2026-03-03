<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use Illuminate\Console\Command;

class AttendanceAutoSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attendance-auto-sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
           $year = now()->year;
    $month = now()->month;

    $service = new \App\Services\Attendance\AttendanceProcessService();
    Attendance::whereYear('date', $year)
    ->whereMonth('date', $month)
    ->cursor()
    ->each(function ($attendance) use ($service) {

        $service->process(
            $attendance->employee_id,
            $attendance->date
        );

    });
    }
}
