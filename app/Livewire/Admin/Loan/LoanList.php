<?php

namespace App\Livewire\Admin\Loan;

use App\Models\Loan;
use Livewire\Component;

class LoanList extends Component
{
    public function render()
    {
        $query = Loan::query();
        return view('livewire.admin.loan.loan-list',[
            'loans' => $query->paginate(10),
        ]);
    }
}
