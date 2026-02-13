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
    public $branches = [];
    public bool $typeModalshow = false;

    public function mount()
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();
    }


    public function addLeaveType($id = null)
    {
        // Reset form
        $this->reset(['leaveTypeId', 'branch_id', 'name', 'annual_limit', 'is_paid']);
        $this->resetErrorBag();
        // Edit mode
        if ($id) {
            $type = ModelsLeaveType::findOrFail($id);

            $this->leaveTypeId = $type->id;
            $this->branch_id = $type->branch_id;
            $this->name = $type->name;
            $this->annual_limit = $type->annual_limit;
            $this->is_paid = $type->is_paid;
        }

        $this->typeModalshow = true;
    }

    public function closeModal()
    {
        $this->typeModalshow = false;
        $this->resetErrorBag();
    }

    public function saveType()
    {
        $storeData = $this->validate(new StoreLeaveTypesRequest()->rules(), new StoreLeaveTypesRequest()->messages());

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
        $checkTypeRequest = Leave::where('leave_type_id',$id)->first();

        if($checkTypeRequest)
            {
         flash()->success('Already has leave request of this Leave Type.');
            }else{
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
