<?php

namespace App\Livewire\Admin\Expense;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Expense;
use App\Models\Branch;
use App\Models\ExpenseType;

class ExpenseManagement extends Component
{
    use WithPagination;

    public $expenseId;
    public $branch_id;
    public $expense_type_id;
    public $name;
    public $amount;
    public $date;

    public $branches = [];
    public $types = [];

    public $isEditMode = false;
    protected $paginationTheme = 'tailwind';

    protected function rules(): array
    {
        return [
            'branch_id' => 'required|exists:branches,id',
            'expense_type_id' => 'required|exists:expense_types,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
        ];
    }

    public function mount()
    {
        $this->branches = Branch::where('status','active')->pluck('name','id')->prepend('Select Branch','')->toArray();
    }

    public function updatedBranchId()
    {
        $this->expense_type_id = null;
        $this->types = ExpenseType::where('branch_id',$this->branch_id)->pluck('name','id')->prepend('Select Type','')->toArray();
    }

    public function resetForm()
    {
        $this->reset(['expenseId','branch_id','expense_type_id','name','amount','date','isEditMode']);
        $this->types = [];
    }

    public function editExpense($id)
    {
        $exp = Expense::findOrFail($id);
        $this->expenseId = $exp->id;
        $this->branch_id = $exp->branch_id;
        $this->expense_type_id = $exp->expense_type_id;
        $this->name = $exp->name;
        $this->amount = $exp->amount;
        $this->date = $exp->date->format('Y-m-d');
        $this->isEditMode = true;
        $this->updatedBranchId();
    }

    public function saveExpense()
    {
        $this->validate();

        if($this->isEditMode){
            Expense::findOrFail($this->expenseId)->update([
                'branch_id'=>$this->branch_id,
                'expense_type_id'=>$this->expense_type_id,
                'name'=>$this->name,
                'amount'=>$this->amount,
                'date'=>$this->date,
            ]);
            session()->flash('success','Expense updated successfully.');
        } else {
            Expense::create([
                'branch_id'=>$this->branch_id,
                'expense_type_id'=>$this->expense_type_id,
                'name'=>$this->name,
                'amount'=>$this->amount,
                'date'=>$this->date,
            ]);
            session()->flash('success','Expense created successfully.');
        }

        $this->resetForm();
        // $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteExpense($id)
    {
        Expense::findOrFail($id)->delete();
        session()->flash('success','Expense deleted successfully.');
    }

    public function render()
    {
        $expenses = Expense::with('branch','type')->latest()->paginate(10);
        return view('livewire.admin.expense.expense-management',compact('expenses'));
    }
}