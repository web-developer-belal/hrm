<?php
namespace App\Livewire\Admin\Shift;

use App\Http\Requests\ShiftRequest;
use App\Models\Shift;
use Carbon\Carbon;
use Livewire\Component;

class ShiftForm extends Component
{
    public bool $isEditMode    = false;
    public string $workingText = '';
    public $shift;
    public $name;
    public $start_time;
    public $end_time;
    public $working_hours = 0;
    public $status = 'active';
    public function mount($shift = null)
    {
        if ($shift) {
            $this->isEditMode = true;
            $this->shift      = Shift::findOrFail($shift);
            $this->name       = $this->shift->name;
            $this->start_time = $this->shift->start_time->format('H:i');
            $this->end_time   = $this->shift->end_time->format('H:i');
            $this->status     = $this->shift->status ? 'active' : 'inactive';
            $this->calculateWorkingHours();
        }
    }
    public function updated($propertyName)
    {
        if ($propertyName === 'start_time' || $propertyName === 'end_time') {
            $this->calculateWorkingHours();
        }
    }
    public function calculateWorkingHours()
    {
        if ($this->start_time && $this->end_time) {

            $start = Carbon::createFromFormat('H:i', $this->start_time);
            $end   = Carbon::createFromFormat('H:i', $this->end_time);

            // end time must be after start time
            if ($end->lessThanOrEqualTo($start)) {
                $this->workingText   = 'End time must be after start time.';
                $this->working_hours = 0;
                return;
            }

            // Calculate difference in minutes, then convert to hours
            $diffInMinutes = $start->diffInMinutes($end);
            $diffInHours   = $diffInMinutes / 60;

            $this->working_hours = round($diffInHours, 2);
            $this->workingText   = "Working Hours: {$this->working_hours} hours";
        } else {
            $this->workingText   = '';
            $this->working_hours = 0;
        }
    }

    public function save()
    {
        $data = $this->validate((new ShiftRequest())->rules(), (new ShiftRequest())->messages());

        if ($this->isEditMode) {
            $this->shift->update($data);
            flash()->success('Shift updated successfully.');
        } else {
            Shift::create($data);
            flash()->success('Shift created successfully.');
            $this->reset(['name', 'start_time', 'end_time', 'status']);
        }
        return redirect()->route('admin.shifts.index');
    }
    public function render()
    {
        return view('livewire.admin.shift.shift-form');
    }
}
