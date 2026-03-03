<?php
namespace App\Livewire\Admin\Transfer;

use App\Models\Transfer;
use Livewire\Component;
use Livewire\WithPagination;

class TransferList extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {
        $query = Transfer::with('employee', 'fromBranch', 'toBranch', 'fromdepartment', 'toDepartment')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->WhereHas('employee', function ($emp) {
                        $emp->where('first_name', 'like', '%' . $this->search . '%')->
                            orWhere('last_name', 'like', '%' . $this->search . '%')->
                            orWhere('employee_code', 'like', '%' . $this->search . '%');
                    });
                });
            })->latest()->paginate(10);

        return view('livewire.admin.transfer.transfer-list', [
            'tranasfers' => $query,
        ]);
    }
}
