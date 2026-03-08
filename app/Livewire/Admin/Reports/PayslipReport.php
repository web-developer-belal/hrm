<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Payroll;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class PayslipReport extends Component
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

    public function getStats()
    {
        // Get payrolls within date range using year/month
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);
        
        $payrolls = Payroll::where(function($query) use ($startDate, $endDate) {
            $query->where('year', '>', $startDate->year)
                  ->orWhere(function($q) use ($startDate) {
                      $q->where('year', $startDate->year)
                        ->where('month', '>=', $startDate->month);
                  });
        })->where(function($query) use ($endDate) {
            $query->where('year', '<', $endDate->year)
                  ->orWhere(function($q) use ($endDate) {
                      $q->where('year', $endDate->year)
                        ->where('month', '<=', $endDate->month);
                  });
        })->get();

        $totalPayroll = $payrolls->sum('gross_salary');
        $totalDeductions = $payrolls->sum('total_deduction');
        $netPay = $payrolls->sum('net_salary');
        $allowances = $payrolls->sum(function($p) {
            return ($p->attendance_bonus ?? 0) + ($p->positive_adjustments ?? 0);
        });

        // Calculate previous period
        $monthsDiff = $startDate->diffInMonths($endDate);
        $prevStart = $startDate->copy()->subMonths($monthsDiff);
        $prevEnd = $startDate->copy()->subMonth();
        
        $prevPayrolls = Payroll::where(function($query) use ($prevStart, $prevEnd) {
            $query->where('year', '>', $prevStart->year)
                  ->orWhere(function($q) use ($prevStart) {
                      $q->where('year', $prevStart->year)
                        ->where('month', '>=', $prevStart->month);
                  });
        })->where(function($query) use ($prevEnd) {
            $query->where('year', '<', $prevEnd->year)
                  ->orWhere(function($q) use ($prevEnd) {
                      $q->where('year', $prevEnd->year)
                        ->where('month', '<=', $prevEnd->month);
                  });
        })->get();

        $prevTotalPayroll = $prevPayrolls->sum('gross_salary');
        $prevTotalDeductions = $prevPayrolls->sum('total_deduction');
        $prevNetPay = $prevPayrolls->sum('net_salary');
        $prevAllowances = $prevPayrolls->sum(function($p) {
            return ($p->attendance_bonus ?? 0) + ($p->positive_adjustments ?? 0);
        });

        return [
            'totalPayroll' => [
                'amount' => $totalPayroll,
                'percentage' => $prevTotalPayroll > 0 ? round((($totalPayroll - $prevTotalPayroll) / $prevTotalPayroll) * 100, 2) : 0,
            ],
            'totalDeductions' => [
                'amount' => $totalDeductions,
                'percentage' => $prevTotalDeductions > 0 ? round((($totalDeductions - $prevTotalDeductions) / $prevTotalDeductions) * 100, 2) : 0,
            ],
            'netPay' => [
                'amount' => $netPay,
                'percentage' => $prevNetPay > 0 ? round((($netPay - $prevNetPay) / $prevNetPay) * 100, 2) : 0,
            ],
            'allowances' => [
                'amount' => $allowances,
                'percentage' => $prevAllowances > 0 ? round((($allowances - $prevAllowances) / $prevAllowances) * 100, 2) : 0,
            ],
        ];
    }

    public function getChartData()
    {
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);
        
        $categories = [];
        $data = [];
        
        // Group by month
        $current = $start->copy()->startOfMonth();
        $endMonth = $end->copy()->endOfMonth();
        
        while ($current->lte($endMonth)) {
            $categories[] = $current->format('M Y');
            
            $monthTotal = Payroll::where('year', $current->year)
                ->where('month', $current->month)
                ->sum('net_salary');
            
            $data[] = round($monthTotal, 2);
            
            $current->addMonth();
        }
        
        return [
            'categories' => $categories,
            'series' => [
                [
                    'name' => 'Net Salary',
                    'data' => $data
                ]
            ],
        ];
    }

    public function render()
    {
        $startDate = Carbon::parse($this->startDate);
        $endDate = Carbon::parse($this->endDate);
        
        $payslips = Payroll::with('employee')
            ->where(function($query) use ($startDate, $endDate) {
                $query->where('year', '>', $startDate->year)
                      ->orWhere(function($q) use ($startDate) {
                          $q->where('year', $startDate->year)
                            ->where('month', '>=', $startDate->month);
                      });
            })->where(function($query) use ($endDate) {
                $query->where('year', '<', $endDate->year)
                      ->orWhere(function($q) use ($endDate) {
                          $q->where('year', $endDate->year)
                            ->where('month', '<=', $endDate->month);
                      });
            })
            ->latest('year')
            ->latest('month')
            ->paginate(10);
        
        $stats = $this->getStats();
        $chartData = $this->getChartData();
            
        return view('livewire.admin.reports.payslip-report', [
            'payslips' => $payslips,
            'stats' => $stats,
            'chartData' => $chartData,
        ]);
    }
}
