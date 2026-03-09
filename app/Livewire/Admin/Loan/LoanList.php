<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Loan;
use Livewire\Component;
use Livewire\WithPagination;

class LoanList extends Component
{
    use WithPagination;
    
    public function render()
    {
        $query = Loan::query();
        return view('livewire.admin.loan.loan-list',[
            'loans' => $query->paginate(10),
        ]);
    }
}
