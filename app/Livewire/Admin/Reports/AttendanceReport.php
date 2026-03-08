<?php
namespace App\Livewire\Admin\Reports;

use App\Models\Attendance;
use App\Models\Holiday;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class AttendanceReport extends Component
{
    use WithPagination;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->subMonth()->format('Y-m-d');
        $this->endDate   = now()->format('Y-m-d');
    }

    #[On('date-range-update')]
    public function dateRangeUpdate($start, $end)
    {
        $this->startDate = $start;
        $this->endDate   = $end;
        $this->dispatch('update-chart', 
            chartData: $this->getChartData(),
            stats: $this->getStats()
        );
    }

    public function getStats()
    {
        $attendances = Attendance::where('date', '>=', $this->startDate)
            ->where('date', '<=', $this->endDate)
            ->get();

        $totalWorkingDays = $attendances->whereIn('status', ['present', 'late'])->count();
        $totalLeave = $attendances->where('status', 'leave')->count();
        $totalHolidays = $attendances->where('status', 'holiday')->count();
        $totalHalfdays = $attendances->where('status', 'half_day')->count();

        // Calculate previous period for comparison
        $daysDiff = Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate));
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');
        
        $prevAttendances = Attendance::where('date', '>=', $prevStart)
            ->where('date', '<=', $prevEnd)
            ->get();

        $prevWorkingDays = $prevAttendances->whereIn('status', ['present', 'late'])->count();
        $prevLeave = $prevAttendances->where('status', 'leave')->count();
        $prevHolidays = $prevAttendances->where('status', 'holiday')->count();
        $prevHalfdays = $prevAttendances->where('status', 'half_day')->count();

        return [
            'workingDays' => [
                'count' => $totalWorkingDays,
                'percentage' => $prevWorkingDays > 0 ? round((($totalWorkingDays - $prevWorkingDays) / $prevWorkingDays) * 100, 2) : 0,
                'progress' => $totalWorkingDays > 0 ? min(100, ($totalWorkingDays / 30) * 100) : 0,
            ],
            'leave' => [
                'count' => $totalLeave,
                'percentage' => $prevLeave > 0 ? round((($totalLeave - $prevLeave) / $prevLeave) * 100, 2) : 0,
                'progress' => $totalLeave > 0 ? min(100, ($totalLeave / 30) * 100) : 0,
            ],
            'holidays' => [
                'count' => $totalHolidays,
                'percentage' => $prevHolidays > 0 ? round((($totalHolidays - $prevHolidays) / $prevHolidays) * 100, 2) : 0,
                'progress' => $totalHolidays > 0 ? min(100, ($totalHolidays / 30) * 100) : 0,
            ],
            'halfdays' => [
                'count' => $totalHalfdays,
                'percentage' => $prevHalfdays > 0 ? round((($totalHalfdays - $prevHalfdays) / $prevHalfdays) * 100, 2) : 0,
                'progress' => $totalHalfdays > 0 ? min(100, ($totalHalfdays / 30) * 100) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        
        $categories = [];
        $presentData = [];
        $absentData = [];
        
        // Group by month if date range is more than 60 days
        if ($start->diffInDays($end) > 60) {
            $current = $start->copy()->startOfMonth();
            $endMonth = $end->copy()->endOfMonth();
            
            while ($current->lte($endMonth)) {
                $monthStart = $current->copy()->startOfMonth();
                $monthEnd = $current->copy()->endOfMonth();
                
                $categories[] = $current->format('M Y');
                
                $present = Attendance::whereIn('status', ['present', 'late'])
                    ->whereBetween('date', [$monthStart, $monthEnd])
                    ->count();
                    
                $absent = Attendance::where('status', 'absent')
                    ->whereBetween('date', [$monthStart, $monthEnd])
                    ->count();
                
                $presentData[] = $present;
                $absentData[] = $absent;
                
                $current->addMonth();
            }
        } else {
            // Group by day
            $current = $start->copy();
            
            while ($current->lte($end)) {
                $categories[] = $current->format('M d');
                
                $present = Attendance::whereIn('status', ['present', 'late'])
                    ->whereDate('date', $current)
                    ->count();
                    
                $absent = Attendance::where('status', 'absent')
                    ->whereDate('date', $current)
                    ->count();
                
                $presentData[] = $present;
                $absentData[] = $absent;
                
                $current->addDay();
            }
        }
        
        return [
            'categories' => $categories,
            'present' => $presentData,
            'absent' => $absentData,
        ];
    }

    public function render()
    {
        $attendanceRecords = Attendance::with('employee')
            ->whereNotNull('status')
            ->where('date', '>=', $this->startDate)
            ->where('date', '<=', $this->endDate)
            ->orderBy('date', 'desc')
            ->paginate(10);
        
        $stats = $this->getStats();
        $chartData = $this->getChartData();
            
        return view('livewire.admin.reports.attendance-report', [
            'attendanceRecords' => $attendanceRecords,
            'stats' => $stats,
            'chartData' => $chartData,
        ]);
    }
}
