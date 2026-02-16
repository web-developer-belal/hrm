<?php

namespace App\Livewire\Admin\PayrollAdjustment;

use App\Models\PayrollAdjustment;
use Livewire\Component;

class AdjustmentAdditionDeduction extends Component
{


    public function render()
    {
        $query = PayrollAdjustment::query();
        return view('livewire.admin.payroll-adjustment.adjustment-addition-deduction',[
            'adjustments' => $query->paginate(10),
        ]);
    }
}
