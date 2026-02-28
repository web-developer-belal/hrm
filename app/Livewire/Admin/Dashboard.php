<?php
namespace App\Livewire\Admin;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\Notice;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $state = [
            'total_employee'          => Employee::count(),
            'total_present'           => Attendance::where('status', 'present')->whereDate('date', today())->count(),
            'total_absent'            => Attendance::where('status', 'absent')->where('date', today())->count(),
            'total_leave'             => Leave::where('status', 'approved')
                ->where(function ($q) {
                    $q->whereDate('from_date', '<=', today())
                        ->orWhereDate('to_date', '>=', today());
                })
                ->count(),
            'total_on_time'           => Attendance::where('status', 'present')->where('late_minutes', '<=', 0)->where('date', today())->count(),
            'total_late'              => Attendance::where('status', 'late')->where('date', today())->count(),
            'total_notice'            => Notice::where('created_at', today())->count(),
            'total_leave_application' => Leave::where('status', 'pending')->count(),
        ];

        $leaves=Leave::latest()->take(5)->get();
        $notices=Notice::latest()->take(5)->get();
        return view('livewire.admin.dashboard', compact('state','leaves','notices'));
    }
}
