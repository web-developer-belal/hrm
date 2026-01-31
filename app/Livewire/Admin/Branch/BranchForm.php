<?php

namespace App\Livewire\Admin\Branch;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Livewire\Component;

use function Flasher\Prime\flash;

class BranchForm extends Component
{
    public $isEditMode = false;
    public $branch;
    public $name;
    public $address;
    public $contact;
    public $status='active';

    public function mount($branch = null)
    {
        if ($branch) {
            $this->isEditMode = true;
            $this->branch = Branch::findOrFail($branch);
            $this->name = $this->branch->name;
            $this->address = $this->branch->address;
            $this->contact = $this->branch->contact;
            $this->status = $this->branch->status;
        }
    }

    public function save(){
        $this->validate((new BranchRequest())->rules(), (new BranchRequest())->messages());
        if ($this->isEditMode) {
            $this->branch->update([
                'name' => $this->name,
                'address' => $this->address,
                'contact' => $this->contact,
                'status' => $this->status,
            ]);
            flash()->success('Branch updated successfully.');
        } else {
            Branch::create([
                'name' => $this->name,
                'address' => $this->address,
                'contact' => $this->contact,
                'status' => $this->status,
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
