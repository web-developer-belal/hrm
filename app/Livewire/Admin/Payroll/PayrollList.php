<?php

namespace App\Livewire\Admin\Payroll;

use App\Models\Payroll;
use Livewire\Component;

class PayrollList extends Component
{
    public function render()
    {
         $query = Payroll::query();
        $query->with(['employee']);
        return view('livewire.admin.payroll.payroll-list',[
            'payrolls'=> $query->paginate(10),
        ]);
    }
}




