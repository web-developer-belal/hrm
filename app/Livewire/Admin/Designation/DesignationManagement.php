<?php
namespace App\Livewire\Admin\Designation;

use App\Models\Designation;
use Livewire\Component;
use Livewire\WithPagination;

class DesignationManagement extends Component
{
    use WithPagination;

    public function toggleStatus($designationId)
    {
        $designation         = Designation::findOrFail($designationId);
        $designation->status = $designation->status === 'active' ? 'inactive' : 'active';
        $designation->save();

        flash()->success('Designation status updated successfully.');
    }

    public function deleteDesignation($designationId)
    {
        $designation = Designation::findOrFail($designationId);
        $designation->delete();

        flash()->success('Designation deleted successfully.');
    }

    public function render()
    {
        $designations = Designation::latest()->paginate(10);
        return view('livewire.admin.designation.designation-management', compact('designations'));
    }
}
