<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Expense;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ExpenseReport extends Component
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
        $expenses = Expense::where('date', '>=', $this->startDate)
            ->where('date', '<=', $this->endDate)
            ->get();

        $totalExpense = $expenses->sum('amount');
        $totalCount = $expenses->count();
        $averageExpense = $totalCount > 0 ? $totalExpense / $totalCount : 0;
        $highestExpense = $expenses->max('amount') ?? 0;

        // Calculate previous period for comparison
        $daysDiff = Carbon::parse($this->startDate)->diffInDays(Carbon::parse($this->endDate));
        $prevStart = Carbon::parse($this->startDate)->subDays($daysDiff)->format('Y-m-d');
        $prevEnd = Carbon::parse($this->startDate)->subDay()->format('Y-m-d');
        
        $prevExpenses = Expense::where('date', '>=', $prevStart)
            ->where('date', '<=', $prevEnd)
            ->get();

        $prevTotalExpense = $prevExpenses->sum('amount');
        $prevTotalCount = $prevExpenses->count();
        $prevAverageExpense = $prevTotalCount > 0 ? $prevTotalExpense / $prevTotalCount : 0;
        $prevHighestExpense = $prevExpenses->max('amount') ?? 0;

        return [
            'totalExpense' => [
                'amount' => $totalExpense,
                'percentage' => $prevTotalExpense > 0 ? round((($totalExpense - $prevTotalExpense) / $prevTotalExpense) * 100, 2) : 0,
            ],
            'totalCount' => [
                'count' => $totalCount,
                'percentage' => $prevTotalCount > 0 ? round((($totalCount - $prevTotalCount) / $prevTotalCount) * 100, 2) : 0,
            ],
            'averageExpense' => [
                'amount' => $averageExpense,
                'percentage' => $prevAverageExpense > 0 ? round((($averageExpense - $prevAverageExpense) / $prevAverageExpense) * 100, 2) : 0,
            ],
            'highestExpense' => [
                'amount' => $highestExpense,
                'percentage' => $prevHighestExpense > 0 ? round((($highestExpense - $prevHighestExpense) / $prevHighestExpense) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        
        $categories = [];
        $expenseData = [];
        
        // Group by month if date range is more than 60 days
        if ($start->diffInDays($end) > 60) {
            $current = $start->copy()->startOfMonth();
            $endMonth = $end->copy()->endOfMonth();
            
            while ($current->lte($endMonth)) {
                $monthStart = $current->copy()->startOfMonth();
                $monthEnd = $current->copy()->endOfMonth();
                
                $categories[] = $current->format('M Y');
                
                $totalAmount = Expense::whereBetween('date', [$monthStart, $monthEnd])
                    ->sum('amount');
                
                $expenseData[] = round($totalAmount, 2);
                
                $current->addMonth();
            }
        } else {
            // Group by day
            $current = $start->copy();
            
            while ($current->lte($end)) {
                $categories[] = $current->format('M d');
                
                $totalAmount = Expense::whereDate('date', $current)
                    ->sum('amount');
                
                $expenseData[] = round($totalAmount, 2);
                
                $current->addDay();
            }
        }
        
        return [
            'categories' => $categories,
            'expenses' => $expenseData,
        ];
    }

    public function render()
    {
        $expenses = Expense::with(['branch', 'type'])
            ->where('date', '>=', $this->startDate)
            ->where('date', '<=', $this->endDate)
            ->latest('date')
            ->paginate(10);
        
        $stats = $this->getStats();
        $chartData = $this->getChartData();
            
        return view('livewire.admin.reports.expense-report', [
            'expenses' => $expenses,
            'stats' => $stats,
            'chartData' => $chartData,
        ]);
    }
}
