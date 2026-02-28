<?php

namespace App\Livewire\Admin\Expense;

use Livewire\Component;
use App\Models\ExpenseType;
use App\Models\Branch;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class ExpenseTypeManagement extends Component
{
    use WithPagination;

    public $typeId;
    public $branch_id;
    public $name;

    public $branches = [];

    public $isEditMode = false;

    protected $paginationTheme = 'tailwind';

    protected function rules(): array
    {
        return [
            'branch_id' => 'required|exists:branches,id',
            'name' => 'required|string|max:255',
        ];
    }

    public function mount()
    {
        $this->branches = Branch::where('status','active')->pluck('name','id')->prepend('Select Branch','')->toArray();
    }

    public function resetForm()
    {
        $this->reset(['typeId','branch_id','name','isEditMode']);
    }

    public function editType($id)
    {
        $type = ExpenseType::findOrFail($id);
        $this->typeId = $type->id;
        $this->branch_id = $type->branch_id;
        $this->name = $type->name;
        $this->isEditMode = true;
    }

    public function saveType()
    {
        $this->validate();

        if($this->isEditMode) {
            ExpenseType::findOrFail($this->typeId)->update([
                'branch_id' => $this->branch_id,
                'name' => $this->name
            ]);
            session()->flash('success','Expense Type updated successfully.');
        } else {
            ExpenseType::create([
                'branch_id' => $this->branch_id,
                'name' => $this->name
            ]);
            session()->flash('success','Expense Type created successfully.');
        }

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteType($id)
    {
        ExpenseType::findOrFail($id)->delete();
        session()->flash('success','Expense Type deleted successfully.');
    }

    public function render()
    {
        $types = ExpenseType::with('branch')->latest()->paginate(10);
        return view('livewire.admin.expense.expense-type-management',compact('types'));
    }
}