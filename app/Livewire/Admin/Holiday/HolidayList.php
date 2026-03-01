<?php

namespace App\Livewire\Admin\Holiday;

use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class HolidayList extends Component
{
    use WithPagination;
    public function render()
    {
        $query = Holiday::query();
        return view('livewire.admin.holiday.holiday-list',[
            'holydays' => $query->paginate(10),
        ]);
    }
}
