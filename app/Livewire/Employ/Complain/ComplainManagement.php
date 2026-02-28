<?php
namespace App\Livewire\Employ\Complain;

use App\Models\Complain;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ComplainManagement extends Component
{
    use WithPagination;
    
    public $employee;

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }

    public function render()
    {
        $query = Complain::with('complainant')->where('employee_id', $this->employee->id);
        // $query->with(['complainant','againstEmp','branch']);
        return view('livewire.employ.complain.complain-management', [
            'complains' => $query->paginate(10),
        ]);
    }

}
