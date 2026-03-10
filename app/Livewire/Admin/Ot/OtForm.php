<?php
namespace App\Livewire\Admin\Ot;

use App\Models\BranchGroup;
use App\Models\Ot;
use Livewire\Component;

class OtForm extends Component
{
    public $isEditMode = false;
    public $otId;
    public $branchGroups = [];
    public $name;
    public $rate;
    public $off_day_counting = false;
    public $branch_group_id;

    public function mount($ot = null)
    {
        $this->branchGroups = BranchGroup::pluck('name', 'id')->prepend('Select Branch Group', '')->toArray();

        if ($ot) {
            $ot=Ot::findOrFail($ot);
            $this->isEditMode       = true;
            $this->otId             = $ot->id;
            $this->name             = $ot->name;
            $this->rate             = $ot->rate;
            $this->off_day_counting = $ot->off_day_counting;
            $this->branch_group_id  = $ot->branch_group_id;
        }
    }
    public function save()
    {
        $validatedData = $this->validate([
            'name'             => 'required|string|max:255',
            'rate'             => 'required|numeric',
            'off_day_counting' => 'boolean',
            'branch_group_id'  => 'required|exists:branch_groups,id',
        ]);

        $validatedData['rate_type'] = 'fixed'; // Set default rate type

        if ($this->isEditMode) {
            $ot = Ot::findOrFail($this->otId);
            $ot->update($validatedData);
        } else {
            Ot::create($validatedData);
        }

        flash()->success($this->isEditMode ? 'Ot updated successfully.' : 'Ot created successfully.');
        return redirect()->route('admin.ot.index');
    }
    public function render()
    {
        return view('livewire.admin.ot.ot-form');
    }
}
