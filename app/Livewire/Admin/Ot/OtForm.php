<?php
namespace App\Livewire\Admin\Ot;

use App\Models\BranchGroup;
use App\Models\Designation;
use App\Models\Ot;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class OtForm extends Component
{
    public $isEditMode = false;
    public $otId;
    public $branchGroups = [];
    public $name;
    public $rate;
    public $off_day_counting = false;
    public $include_in_payroll = false;
    public $branch_group_id;
    public $designations = [];
    public $designation_rates = [];

    public function mount($ot = null)
    {
        $this->branchGroups = BranchGroup::pluck('name', 'id')->toArray();

        if ($ot) {
            $ot=Ot::findOrFail($ot);
            $this->isEditMode       = true;
            $this->otId             = $ot->id;
            $this->name             = $ot->name;
            $this->rate             = $ot->rate;
            $this->off_day_counting = $ot->off_day_counting;
            $this->include_in_payroll = $ot->include_in_payroll;
            $this->branch_group_id  = $ot->branch_group_id;

            $this->loadDesignationsByGroup();
            $existingRates = $ot->rates()->pluck('rate', 'designation_id')->toArray();

            foreach ($this->designations as $designation) {
                $this->designation_rates[$designation['id']] = isset($existingRates[$designation['id']])
                    ? (float) $existingRates[$designation['id']]
                    : null;
            }
        }
    }

    public function updatedBranchGroupId(): void
    {
        $this->loadDesignationsByGroup();
    }

    protected function loadDesignationsByGroup(): void
    {
        $this->designations = [];
        $this->designation_rates = [];

        if (! $this->branch_group_id) {
            return;
        }

        $designations = Designation::query()
            ->select('designations.id', 'designations.name')
            ->where('designations.status', 'active')
            ->whereHas('department', function ($q) {
                $q->where('status', 'active')
                    ->whereHas('branch', function ($q2) {
                        $q2->where('status', 'active')
                            ->where('branch_group_id', $this->branch_group_id);
                    });
            })
            ->orderBy('designations.name')
            ->get();

        $this->designations = $designations
            ->map(fn($designation) => [
                'id' => $designation->id,
                'name' => $designation->name,
            ])
            ->values()
            ->toArray();

        foreach ($this->designations as $designation) {
            $this->designation_rates[$designation['id']] = null;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name'             => 'required|string|max:255',
            'off_day_counting' => 'nullable|boolean',
            'include_in_payroll' => 'nullable|boolean',
            'branch_group_id'  => 'required|exists:branch_groups,id',
            'designation_rates' => 'required|array|min:1',
            'designation_rates.*' => 'required|numeric|min:0',
        ]);

        $validatedData['off_day_counting'] = $this->off_day_counting ? true : false;
        $validatedData['include_in_payroll'] = $this->include_in_payroll ? true : false;

        $allowedDesignationIds = collect($this->designations)
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->all();

        $rates = collect($validatedData['designation_rates'])
            ->filter(fn($rate, $designationId) => in_array((string) $designationId, $allowedDesignationIds, true))
            ->map(fn($rate) => (float) $rate)
            ->all();

        if (empty($rates)) {
            throw ValidationException::withMessages([
                'designation_rates' => 'No valid designation rates found for selected branch group.',
            ]);
        }

        DB::transaction(function () use ($validatedData, $rates) {
            if ($this->isEditMode) {
                $ot = Ot::findOrFail($this->otId);
                $ot->update([
                    'name' => $validatedData['name'],
                    'branch_group_id' => $validatedData['branch_group_id'],
                    'off_day_counting' => $validatedData['off_day_counting'],
                    'include_in_payroll' => $validatedData['include_in_payroll'],
                ]);
            } else {
                $ot = Ot::create([
                    'name' => $validatedData['name'],
                    'branch_group_id' => $validatedData['branch_group_id'],
                    'off_day_counting' => $validatedData['off_day_counting'],
                    'include_in_payroll' => $validatedData['include_in_payroll'],
                ]);
            }

            $ot->rates()->delete();

            foreach ($rates as $designationId => $rate) {
                $ot->rates()->create([
                    'designation_id' => $designationId,
                    'rate' => $rate,
                ]);
            }
        });

        flash()->success($this->isEditMode ? 'Ot updated successfully.' : 'Ot created successfully.');
        return redirect()->route('admin.ot.index');
    }
    public function render()
    {
        return view('livewire.admin.ot.ot-form');
    }
}
