<?php
namespace App\Livewire\Admin\Leavemgt;

use App\Http\Requests\StoreLeaveTypesRequest;
use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Leave;
use App\Models\LeaveType as ModelsLeaveType;
use Livewire\Component;

class LeaveType extends Component
{
    public $name, $annual_limit, $is_paid, $branch_id=[], $leaveTypeId;
    public $branch_id_options = [];
    public $branch_id_search;
    public bool $typeModalShow = false;

    public $group;
    public $group_options = [];
    public $group_search;

    public function mount()
    {
        $this->loadBranches();
        $this->loadGroups();
    }
    protected function loadBranches(): void
    {
        $this->branch_id_options = Branch::query()
            ->where('status', 'active')
            ->when($this->group, fn($q) =>
                $q->where('branch_group_id', $this->group)
            )
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function loadGroups()
    {
        $this->group_options = BranchGroup::query()
            ->when($this->group_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->group_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedGroupSearch(): void
    {
        $this->loadGroups();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranches();
    }

    public function updatedGroup(): void
    {
        $this->loadBranches();
        if ($this->leaveTypeId) {
            $this->branch_id = array_key_first($this->branch_id_options) ?? null;
        } else {
            // Select all branches in this group by default
            $this->branch_id = array_keys($this->branch_id_options);
        }
    }

    public function addLeaveType($id = null)
    {
        // Reset form
        $this->reset(['leaveTypeId', 'branch_id', 'name', 'annual_limit', 'is_paid']);
        $this->resetErrorBag();
        // Edit mode
        if ($id) {
            $type = ModelsLeaveType::findOrFail($id);

            $this->leaveTypeId  = $type->id;
            $this->branch_id    = $type->branch_id;
            $this->name         = $type->name;
            $this->annual_limit = $type->annual_limit;
            $this->is_paid      = $type->is_paid;
        }

        $this->typeModalShow = true;
    }

    public function toggleStatus($id)
    {
        $leave          = ModelsLeaveType::findOrFail($id);
        $leave->is_paid = $leave->is_paid == 0 ? 1 : 0;
        $leave->save();

    }

    public function closeModal()
    {
        $this->typeModalShow = false;
        $this->resetErrorBag();
    }

    public function saveType()
    {
        $rules = (new StoreLeaveTypesRequest())->rules();
        $messages = (new StoreLeaveTypesRequest())->messages();

        if ($this->leaveTypeId) {
            $storeData = $this->validate(
                array_merge($rules, [
                    'branch_id' => 'required|exists:branches,id',
                ]),
                $messages
            );

            $type = ModelsLeaveType::findOrFail($this->leaveTypeId);
            $type->update($storeData);
        } else {
            $storeData = $this->validate(
                array_merge($rules, [
                    'branch_id' => 'required|array|min:1',
                    'branch_id.*' => 'exists:branches,id',
                ]),
                array_merge($messages, [
                    'branch_id.required' => 'Please select at least one branch.',
                    'branch_id.array' => 'Branch selection must be a valid array.',
                    'branch_id.*.exists' => 'One or more selected branches are invalid.',
                ])
            );

            $branchIds = is_array($this->branch_id) ? $this->branch_id : [$this->branch_id];

            foreach ($branchIds as $branchId) {
                ModelsLeaveType::create([
                    'branch_id' => $branchId,
                    'name' => $storeData['name'],
                    'annual_limit' => $storeData['annual_limit'],
                    'is_paid' => $storeData['is_paid'],
                ]);
            }
        }

        flash()->success($this->leaveTypeId ? 'Leave Type updated successfully.' : 'Leave Type created successfully.');

        $this->closeModal();
    }

    public function deleteLeaveType($id)
    {
        $checkTypeRequest = Leave::where('leave_type_id', $id)->first();

        if ($checkTypeRequest) {
            flash()->success('Already has leave request of this Leave Type.');
        } else {
            $type = ModelsLeaveType::findOrFail($id);
            $type->delete();
            flash()->success('Leave type deleted successfully!');
        }

    }

    public function render()
    {
        $leaveTypes = ModelsLeaveType::with(['branch'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.leavemgt.leave-type', compact('leaveTypes'));
    }
}
