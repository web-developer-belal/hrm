<?php

namespace App\Livewire\Admin\Payroll\Rule;

use App\Models\BranchGroup;
use App\Models\PayrollRule;
use Livewire\Component;
use Livewire\WithPagination;

class RuleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';
    public $calc_type = '';
    public $condition_type = '';
    public $status = '';
    public $branch_group_id = '';

    public $branch_group_options = [];

    public function mount(): void
    {
        $this->branch_group_options = BranchGroup::pluck('name', 'id')->toArray();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedType(): void
    {
        $this->resetPage();
    }

    public function updatedCalcType(): void
    {
        $this->resetPage();
    }

    public function updatedConditionType(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function updatedBranchGroupId(): void
    {
        $this->resetPage();
    }

    public function toggleStatus($ruleId): void
    {
        $rule = PayrollRule::findOrFail($ruleId);
        $rule->update(['is_active' => ! $rule->is_active]);
        flash()->success('Rule status updated successfully.');
    }

    public function deleteRule($ruleId): void
    {
        $rule = PayrollRule::findOrFail($ruleId);
        $rule->delete();
        flash()->success('Rule deleted successfully.');
    }

    public function render()
    {
        $rules = PayrollRule::query()
            ->with('branchGroup')
            ->when($this->search, fn ($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
            )
            ->when($this->type, fn ($q) =>
                $q->where('type', $this->type)
            )
            ->when($this->calc_type, fn ($q) =>
                $q->where('calc_type', $this->calc_type)
            )
            ->when($this->condition_type, fn ($q) =>
                $q->where('condition_type', $this->condition_type)
            )
            ->when($this->status !== '', fn ($q) =>
                $q->where('is_active', (bool) $this->status)
            )
            ->when($this->branch_group_id, fn ($q) =>
                $q->where('branch_group_id', $this->branch_group_id)
            )
            ->latest()
            ->paginate(15);

        return view('livewire.admin.payroll.rule.rule-management', [
            'rules' => $rules,
        ]);
    }
}
