<?php
namespace App\Livewire\Employ;

use App\Models\Notice as ModelsNotice;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Notice extends Component
{
    use WithPagination;
    public $employee;
    public $search;
    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();
    }
    public function render()
    {
        $notices = ModelsNotice::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->where('branch_id', $this->employee->branch_id)->where('department_id', $this->employee->department_id)->where('status','active')->latest()->paginate(10);
        return view('livewire.employ.notice', compact('notices'));
    }
}
