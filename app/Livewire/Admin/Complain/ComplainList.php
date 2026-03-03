<?php
namespace App\Livewire\Admin\Complain;

use App\Models\Branch;
use App\Models\Complain;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ComplainList extends Component
{

    public bool $Modalshow = false;
    public $complain;

    #[Validate('required')]
    public $status;
    public $remarks;

    public $branches = [];
    public $branches_options = [];
    public $branches_search;
    public $search;

    public function mount()
    {
        $this->loadBranches();
    }

    protected function loadBranches(): void
    {
        $this->branches_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branches_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branches_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchesSearch(): void
    {
        $this->loadBranches();
    }
    public function checkedComplain($id)
    {
        $this->Modalshow = true;
        $this->complain  = Complain::find($id);
    }
    public function closeModal()
    {
        $this->Modalshow = false;
        $this->resetErrorBag();
    }

    public function resolveComplain()
    {
        $this->complain->update([
            'status'  => $this->status,
            'remarks' => $this->remarks,
        ]);
        $this->Modalshow = false;
        $this->resetErrorBag();
    }
    public function render()
    {
        $query = Complain::when($this->search, function ($q) {
            $q->WhereHas('complainant', function ($emp) {
                $emp->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('employee_code', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('againstEmp', function ($emp) {
                    $emp->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->search . '%');
                });
        })
            ->when($this->branches, function ($q) {
                $q->whereIn('branch_id', (array) $this->branches);
            })->latest()->paginate(10);

        return view('livewire.admin.complain.complain-list', [
            'complains' => $query,
        ]);
    }
}
