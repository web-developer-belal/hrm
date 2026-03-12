<?php

namespace App\Livewire\Admin\Payroll\Rule;

use App\Models\BranchGroup;
use App\Models\PayrollRule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RuleFrom extends Component
{
    public $isEditMode = false;
    public $rule;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|in:bonus,deduction')]
    public $type = 'bonus';

    #[Validate('required|in:fixed,percentage,per_day')]
    public $calc_type = 'fixed';

    #[Validate('required|numeric|min:0')]
    public $value = '';

    #[Validate('required|in:always,min_present_days,date_range')]
    public $condition_type = 'always';

    #[Validate('nullable|integer|min:1')]
    public $condition_present_days = null;

    #[Validate('nullable|date')]
    public $condition_from = null;

    #[Validate('nullable|date|after_or_equal:condition_from')]
    public $condition_to = null;

    #[Validate('nullable|exists:branch_groups,id')]
    public $branch_group_id = null;

    #[Validate('boolean')]
    public $is_active = true;

    public $branch_group_options = [];

    public function mount($ruleId = null): void
    {
        $this->branch_group_options = BranchGroup::pluck('name', 'id')->toArray();

        if ($ruleId) {
            $this->isEditMode = true;
            $this->rule = PayrollRule::findOrFail($ruleId);

            $this->name = $this->rule->name;
            $this->type = $this->rule->type;
            $this->calc_type = $this->rule->calc_type;
            $this->value = $this->rule->value;
            $this->condition_type = $this->rule->condition_type;
            $this->condition_present_days = $this->rule->condition_present_days;
            $this->condition_from = optional($this->rule->condition_from)->format('Y-m-d');
            $this->condition_to = optional($this->rule->condition_to)->format('Y-m-d');
            $this->branch_group_id = $this->rule->branch_group_id;
            $this->is_active = (bool) $this->rule->is_active;
        }
    }

    public function updatedConditionType(): void
    {
        if ($this->condition_type !== 'min_present_days') {
            $this->condition_present_days = null;
        }

        if ($this->condition_type !== 'date_range') {
            $this->condition_from = null;
            $this->condition_to = null;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->condition_type === 'min_present_days' && empty($this->condition_present_days)) {
            $this->addError('condition_present_days', 'Min present days is required for this condition type.');
            return;
        }

        if ($this->condition_type === 'date_range' && (empty($this->condition_from) || empty($this->condition_to))) {
            $this->addError('condition_from', 'Date range fields are required for this condition type.');
            return;
        }

        $payload = [
            'name' => $this->name,
            'type' => $this->type,
            'calc_type' => $this->calc_type,
            'value' => $this->value,
            'condition_type' => $this->condition_type,
            'condition_present_days' => $this->condition_type === 'min_present_days' ? $this->condition_present_days : null,
            'condition_from' => $this->condition_type === 'date_range' ? $this->condition_from : null,
            'condition_to' => $this->condition_type === 'date_range' ? $this->condition_to : null,
            'branch_group_id' => $this->branch_group_id ?: null,
            'is_active' => (bool) $this->is_active,
        ];

        if ($this->isEditMode) {
            $this->rule->update($payload);
            flash()->success('Payroll rule updated successfully.');
        } else {
            PayrollRule::create($payload);
            flash()->success('Payroll rule created successfully.');
        }

        return redirect()->route('admin.payroll.rule.index');
    }

    public function render()
    {
        return view('livewire.admin.payroll.rule.rule-from');
    }
}
