<?php

namespace App\Livewire\Admin;

use App\Models\Branch;
use App\Models\BranchGroup;
use App\Models\Holiday;
use Livewire\Component;

class Calender extends Component
{
    public $group;
    public $group_options;
    public $group_search;

    public $branch;
    public $branch_options;
    public $branch_search;

    public function mount()
    {
        $this->loadGroupOptions();
        $this->loadBranchOptions();
    }

    public function updatedGroupSearch()
    {
        $this->loadGroupOptions();
    }

    public function updatedGroup()
    {
        $this->branch = null;
        $this->loadBranchOptions();
    }

    public function updatedBranchSearch()
    {
        $this->loadBranchOptions();
    }

    public function loadGroupOptions()
    {
        $this->group_options = BranchGroup::query()
            ->when($this->group_search, function ($query) {
                $query->where('name', 'like', '%' . $this->group_search . '%');
            })
            ->limit(5)
            ->pluck('name', 'id')
            ->prepend('Clear -- Group', '')
            ->toArray();
    }

    public function loadBranchOptions()
    {
        $this->branch_options = Branch::query()
            ->whereHas('holidays')
            ->when($this->group, function ($query) {
                $query->where('branch_group_id', $this->group);
            })
            ->when($this->branch_search, function ($query) {
                $query->where('name', 'like', '%' . $this->branch_search . '%');
            })
            ->limit($this->group ? 1000 : 5)
            ->pluck('name', 'id')
            ->prepend('Clear -- Branch', '')
            ->toArray();

        if ($this->branch !== null && $this->branch !== '' && ! array_key_exists($this->branch, $this->branch_options)) {
            $this->branch = null;
        }
    }

    public function render()
    {
        $holidays = Holiday::query()
            ->with('branch')
            ->when($this->group, function ($query) {
                $query->whereHas('branch', function ($branchQuery) {
                    $branchQuery->where('branch_group_id', $this->group);
                });
            })
            ->when($this->branch, function ($query) {
                $query->where('branch_id', $this->branch);
            })
            ->get();

        // Format holidays for FullCalendar
        $holidayEvents = $holidays->map(function ($holiday) {
            return [
                'title' => $holiday->name,
                'start' => $holiday->date,
                'end' => $holiday->date,
                'backgroundColor' => '#FFE5CC',
                'textColor' => '#D97706',
                'className' => 'badge badge-warning-transparent',
                'extendedProps' => [
                    'isHoliday' => true,
                    'branchName' => $holiday->branch?->name,
                ]
            ];
        })->values()->all();

        return view('livewire.admin.calender', [
            'holidayEvents' => $holidayEvents,
        ]);
    }
}
