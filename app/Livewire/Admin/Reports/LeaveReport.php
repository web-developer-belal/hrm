<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Leave;
use App\Models\LeaveType;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class LeaveReport extends Component
{
    use WithPagination;
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->startDate = now()->startOfYear()->format('Y-m-d');
        $this->endDate   = now()->endOfYear()->format('Y-m-d');
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

    public function statusChange($leaveId, $status)
    {
        $leave = Leave::find($leaveId);
        if ($leave) {
            $leave->status = $status;
            $leave->save();
            
            $this->dispatch('alert', [
                'type' => 'success',
                'message' => 'Leave status updated successfully!'
            ]);
        }
    }

    public function getStats()
    {
        $leaves = Leave::whereBetween('from_date', [$this->startDate, $this->endDate])
            ->get();

        $totalLeaves = $leaves->count();
        $approvedLeaves = $leaves->where('status', 'approved')->count();
        $pendingLeaves = $leaves->where('status', 'pending')->count();
        $rejectedLeaves = $leaves->where('status', 'rejected')->count();

        // Calculate previous period for comparison
        $daysDiff = Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate));
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');
        
        $prevLeaves = Leave::whereBetween('from_date', [$prevStart, $prevEnd])
            ->get();

        $prevTotalLeaves = $prevLeaves->count();
        $prevApprovedLeaves = $prevLeaves->where('status', 'approved')->count();
        $prevPendingLeaves = $prevLeaves->where('status', 'pending')->count();
        $prevRejectedLeaves = $prevLeaves->where('status', 'rejected')->count();

        return [
            'totalLeaves' => [
                'count' => $totalLeaves,
                'percentage' => $prevTotalLeaves > 0 ? round((($totalLeaves - $prevTotalLeaves) / $prevTotalLeaves) * 100, 2) : 0,
            ],
            'approvedLeaves' => [
                'count' => $approvedLeaves,
                'percentage' => $prevApprovedLeaves > 0 ? round((($approvedLeaves - $prevApprovedLeaves) / $prevApprovedLeaves) * 100, 2) : 0,
            ],
            'pendingLeaves' => [
                'count' => $pendingLeaves,
                'percentage' => $prevPendingLeaves > 0 ? round((($pendingLeaves - $prevPendingLeaves) / $prevPendingLeaves) * 100, 2) : 0,
            ],
            'rejectedLeaves' => [
                'count' => $rejectedLeaves,
                'percentage' => $prevRejectedLeaves > 0 ? round((($rejectedLeaves - $prevRejectedLeaves) / $prevRejectedLeaves) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        
        // Get all leave types
        $leaveTypes = LeaveType::all();
        
        $categories = [];
        $series = [];
        
        // Initialize series for each leave type
        foreach ($leaveTypes as $type) {
            $series[$type->id] = [
                'name' => $type->name,
                'data' => []
            ];
        }
        
        // Group by month
        $current = $start->copy()->startOfMonth();
        $endMonth = $end->copy()->endOfMonth();
        
        while ($current->lte($endMonth)) {
            $monthStart = $current->copy()->startOfMonth();
            $monthEnd = $current->copy()->endOfMonth();
            
            $categories[] = $current->format('M');
            
            // Get leaves for each type in this month
            foreach ($leaveTypes as $type) {
                $count = Leave::where('leave_type_id', $type->id)
                    ->where('status', 'approved')
                    ->where(function($query) use ($monthStart, $monthEnd) {
                        $query->whereBetween('from_date', [$monthStart, $monthEnd])
                              ->orWhereBetween('to_date', [$monthStart, $monthEnd]);
                    })
                    ->count();
                
                $series[$type->id]['data'][] = $count;
            }
            
            $current->addMonth();
        }
        
        return [
            'categories' => $categories,
            'series' => array_values($series),
        ];
    }

    public function render()
    {
        $leaves = Leave::with(['employee', 'type'])
            ->whereBetween('from_date', [$this->startDate, $this->endDate])
            ->latest('from_date')
            ->paginate(10);
        
        $stats = $this->getStats();
        $chartData = $this->getChartData();
            
        return view('livewire.admin.reports.leave-report', [
            'leaves' => $leaves,
            'stats' => $stats,
            'chartData' => $chartData,
        ]);
    }
}
