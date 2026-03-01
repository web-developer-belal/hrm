<?php

namespace App\Livewire\Admin\Holiday;

use App\Models\Attendance;
use App\Models\Branch;
use App\Models\Holiday;
use Livewire\Attributes\Validate;
use Livewire\Component;
use DB;

class HolidayAdd extends Component
{
    public $branches = [];

    #[Validate('required')]
    public $name;
    public $branch_id;
    #[Validate('required|date|unique:holidays,date')]
    public $date;

        public function mount($department = null)
        {
            $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', 0)->toArray();

        }

        public function saveHoliday()
        {
            // dd($this->branch_id);
            $validatedData = $this->validate();
            DB::beginTransaction();
            try {
            Holiday::create([
                'name' => $this->name,
                'branch_id' => $this->branch_id,
                'date' => $this->date,
            ]);

            if($this->branch_id)
            {
                Attendance::where('branch_id',$this->branch_id)->whereDate('date', $this->date)->update(['status' => 'holiday']);
            }else{
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
