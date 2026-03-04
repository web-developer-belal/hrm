<?php
namespace App\Livewire\Admin\Holiday;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class HolidayAdd extends Component
{
    #[Validate('required')]
    public $name;
    public $branch_id;
    #[Validate('required|date|unique:holidays,date')]
    public $date;
    public $branch_id_options = [];
    public $branch_id_search;

    public function mount()
    {
        $this->loadBranches();
    }

    protected function loadBranches(): void
    {
        $this->branch_id_options = Branch::query()
            ->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function updatedBranchIdSearch(): void
    {
        $this->loadBranches();
    }

    public function saveHoliday()
    {
        $this->validate();
        DB::beginTransaction();
        try {
            Holiday::create([
                'name'      => $this->name,
                'branch_id' => $this->branch_id,
                'date'      => $this->date,
            ]);

            if ($this->branch_id) {
                Attendance::where('branch_id', $this->branch_id)->whereDate('date', $this->date)->update(['status' => 'holiday']);
            } else {
                Attendance::whereDate('date', $this->date)->update(['status' => 'holiday']);
            }

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
