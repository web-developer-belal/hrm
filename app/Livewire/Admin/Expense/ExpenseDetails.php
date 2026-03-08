<?php

namespace App\Livewire\Admin\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseDetails extends Component
{
    public $expense;
    public function mount($expense)
    {
        // You can load the expense details here using the $expense parameter
        // For example:
        $this->expense = Expense::findOrFail($expense)->load('branch', 'type');
    }
    public function render()
    {
        return view('livewire.admin.expense.expense-details');
    }
}
