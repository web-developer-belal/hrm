<?php
namespace App\Livewire\Admin\Payroll;

use App\Models\Payroll;
use Livewire\Component;

class ExportPayRoll extends Component
{
    public $payrolls;

    public function mount($payrolls)
    {
        $ids=explode(',', $payrolls);
        $payrolls = Payroll::with(['employee', 'branch'])->whereIn('id', $ids)->get();
        $this->payrolls = $payrolls;
    }

    public function render()
    {
        return view('livewire.admin.payroll.export-pay-roll');
    }
}
