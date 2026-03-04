<?php
namespace App\Livewire\Admin\Expense;

use App\Models\Branch;
use App\Models\ExpenseType;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

class ExpenseTypeManagement extends Component
{
    use WithPagination;

    public $typeId;
    public $branch_id;
    public $name;

    public $branch_id_options = [];
    public $branch_id_search;

    public $isEditMode = false;

    protected function rules(): array
    {
        return [
            'branch_id' => 'required|exists:branches,id',
            'name'      => 'required|string|max:255|unique:expense_types,name,' . $this->typeId,
        ];
    }

    public function mount()
    {
        $this->loadBranchOptions();
    }

    public function loadBranchOptions()
    {
        $this->branch_id_options = Branch::where('status', 'active')->when($this->branch_id_search, function ($query) {
            $query->where('name', 'like', '%' . $this->branch_id_search . '%');
        })
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranchOptions();
    }

    public function resetForm()
    {
        $this->reset(['typeId', 'branch_id', 'name', 'isEditMode']);
    }

    public function editType($id)
    {
        $type             = ExpenseType::findOrFail($id);
        $this->typeId     = $type->id;
        $this->branch_id  = $type->branch_id;
        $this->name       = $type->name;
        $this->isEditMode = true;
    }

    public function saveType()
    {
        $this->validate();

        if ($this->isEditMode) {
            ExpenseType::findOrFail($this->typeId)->update([
                'branch_id' => $this->branch_id,
                'name'      => $this->name,
            ]);
            flash()->success('Expense Type updated successfully.');
        } else {
            ExpenseType::create([
                'branch_id' => $this->branch_id,
                'name'      => $this->name,
            ]);
            flash()->success('Expense Type created successfully.');
        }

        $this->resetForm();
        $this->dispatch('close-modal');
    }

    public function deleteType($id)
    {
        ExpenseType::findOrFail($id)->delete();
        flash()->success('Expense Type deleted successfully.');
    }

    public function render()
    {
        $types = ExpenseType::with('branch')->latest()->paginate(10);
        return view('livewire.admin.expense.expense-type-management', compact('types'));
    }
}
