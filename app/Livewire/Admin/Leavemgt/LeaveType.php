<?php
namespace App\Livewire\Admin\Leavemgt;

use App\Http\Requests\StoreLeaveTypesRequest;
use App\Models\Branch;
use App\Models\Leave;
use App\Models\LeaveType as ModelsLeaveType;
use Livewire\Component;

class LeaveType extends Component
{
    public $name, $annual_limit, $is_paid, $branch_id, $leaveTypeId;
    public $branch_id_options = [];
    public $branch_id_search;
    public bool $typeModalShow = false;

    public function mount()
    {
        $this->loadBranchIdOptions();
    }
    protected function loadBranchIdOptions()
    {
        $this->branch_id_options = Branch::where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranchIdOptions();
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
        $leave         = ModelsLeaveType::find($id);
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
        $storeData = $this->validate(
            (new StoreLeaveTypesRequest())->rules(),
            (new StoreLeaveTypesRequest())->messages()
        );

        if ($this->leaveTypeId) {
            $type = ModelsLeaveType::findOrFail($this->leaveTypeId);
            $type->update($storeData);
        } else {
            ModelsLeaveType::create($storeData);
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
