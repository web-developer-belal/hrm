<?php
namespace App\Livewire\Admin\Holiday;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class HolidayAdd extends Component
{
    #[Validate('required')]
    public $name;
    public $branch_id=[];
    #[Validate('required|date')]
    public $date;
    public $branch_id_options = [];
    public $branch_id_search;

    public $group;
    public $group_options = [];
    public $group_search;

    public function mount()
    {
        $this->loadBranches();
        $this->loadGroups();
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

    public function updatedGroup(): void
    {
        $this->loadBranches();
        $this->branch_id = array_keys($this->branch_id_options);
    }

    protected function loadBranches(): void
    {
        $this->branch_id_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )->when($this->group, fn($q) =>
            $q->where('branch_group_id', $this->group)
        )
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch(): void
    {
        $this->loadBranches();
    }

    public function saveHoliday()
    {
        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'branch_id' => 'required|array|min:1',
            'branch_id.*' => 'exists:branches,id',
            'date' => 'required|date',
        ], [
            'branch_id.required' => 'Please select at least one branch.',
            'branch_id.array' => 'Branch selection must be a valid array.',
            'branch_id.*.exists' => 'One or more selected branches are invalid.',
        ]);

        $branchIds = is_array($this->branch_id) ? $this->branch_id : [$this->branch_id];

        DB::beginTransaction();
        try {
            foreach ($branchIds as $branchId) {
                Holiday::create([
                    'name'      => $validated['name'],
                    'branch_id' => $branchId,
                    'date'      => $validated['date'],
                ]);
            }

            Attendance::whereIn('branch_id', $branchIds)
                ->whereDate('date', $validated['date'])
                ->update(['status' => 'holiday']);

            DB::commit();
            flash()->success('Holiday created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error('Holiday created failed.');
            throw $e;
        }

        return redirect()->route('admin.holiday.index');
    }
    public function render()
    {
        return view('livewire.admin.holiday.holiday-add');
    }
}
