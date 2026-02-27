<?php

namespace App\Livewire\Admin\Attendance;
use App\Models\Attendance;
use App\Services\Attendance\AttendanceProcessService;

use Livewire\Component;
use Livewire\WithPagination;

class AttendanceList extends Component
{
    use WithPagination;

   public $processDate;
public $isProcessing = false;

public function processRunningMonth()
{

    $this->isProcessing = true;

    $year = now()->year;
    $month = now()->month;

    $service = new \App\Services\Attendance\AttendanceProcessService();

    // Attendance::whereYear('date', $year)
    //     ->whereMonth('date', $month)
    //     ->chunk(200, function ($records) use ($service) {

    //         foreach ($records as $attendance) {
    //             $service->process(
    //                 $attendance->employee_id,
    //                 $attendance->date
    //             );
    //         }

    //     });
    Attendance::whereYear('date', $year)
    ->whereMonth('date', $month)
    ->cursor()
    ->each(function ($attendance) use ($service) {

        $service->process(
            $attendance->employee_id,
            $attendance->date
        );

    });



   flash()->success('Attendance Sync successfully.');
}

    public function render()
    {

        $query = Attendance::query();

            $query->where('date',today());
        return view('livewire.admin.attendance.attendance-list',[
            'attendancelist'=> $query->paginate(10),
        ]);
    }
}
