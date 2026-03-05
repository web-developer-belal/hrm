<?php

namespace App\Livewire\Admin\Reports;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseReport extends Component
{
    use WithPagination;
    public function render()
    {
        $expenses = Expense::with('employee')->latest()->paginate(10);
        return view('livewire.admin.reports.expense-report', compact('expenses'));
    }
}
