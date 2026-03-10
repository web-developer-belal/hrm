<?php
namespace App\Livewire\Admin\Branch;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use App\Models\BranchGroup;
use function Flasher\Prime\flash;
use Livewire\Component;

class BranchForm extends Component
{
    public $isEditMode = false;
    public $branch;
    public $name;
    public $address;
    public $contact;
    public $status = 'active';

    public $groups = [];
    public $branch_group_id;

    public function mount($branch = null)
    {
        $this->groups = BranchGroup::orderBy('name')->pluck('name', 'id')->prepend('Select Group', '')->toArray();
        if ($branch) {
            $this->isEditMode      = true;
            $this->branch          = Branch::findOrFail($branch);
            $this->name            = $this->branch->name;
            $this->address         = $this->branch->address;
            $this->contact         = $this->branch->contact;
            $this->status          = $this->branch->status;
            $this->branch_group_id = $this->branch->branch_group_id;
        }
    }

    public function save()
    {
        $this->validate((new BranchRequest())->rules(), (new BranchRequest())->messages());
        if ($this->isEditMode) {
            $this->branch->update([
                'name'            => $this->name,
                'address'         => $this->address,
                'contact'         => $this->contact,
                'status'          => $this->status,
                'branch_group_id' => $this->branch_group_id ?? null,
            ]);
            flash()->success('Branch updated successfully.');
        } else {
            Branch::create([
                'name'            => $this->name,
                'address'         => $this->address,
                'contact'         => $this->contact,
                'status'          => $this->status,
                'branch_group_id' => $this->branch_group_id ?? null,
            ]);
            flash()->success('Branch created successfully.');
            // $this->reset();
        }
        return redirect()->route('admin.branches.index');
    }

    public function render()
    {
        return view('livewire.admin.branch.branch-form');
    }
}
