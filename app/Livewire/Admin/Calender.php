<?php

namespace App\Livewire\Admin;

use App\Models\Branch;
use App\Models\Holiday;
use Livewire\Component;

class Calender extends Component
{
    public $branch;
    public $branch_options;
    public $branch_search;

    public function mount()
    {
        $this->loadBranchOptions();
    }

    public function updatedBranchSearch()
    {
        $this->loadBranchOptions();
    }

    public function loadBranchOptions()
    {
        $this->branch_options = Branch::whereHas('holidays')->when($this->branch_search, function($query) {
            $query->where('name', 'like', '%' . $this->branch_search . '%');
        })->take(5)->pluck('name', 'id')->prepend('Clear -- Branch', '')->toArray();
    }

    public function render()
    {
        $holidays = Holiday::when($this->branch, function($query) {
            $query->where('branch_id', $this->branch);
        })->get();

        // Format holidays for FullCalendar
        $holidayEvents = $holidays->map(function($holiday) {
            return [
                'title' => $holiday->name,
                'start' => $holiday->date,
                'end' => $holiday->date,
                'backgroundColor' => '#FFE5CC',
                'textColor' => '#D97706',
                'className' => 'badge badge-warning-transparent',
                'extendedProps' => [
                    'isHoliday' => true,
                ]
            ];
        })->toJson();

        return view('livewire.admin.calender', [
            'holidayEvents' => $holidayEvents,
        ]);
    }
}
