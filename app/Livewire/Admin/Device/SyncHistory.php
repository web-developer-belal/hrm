<?php

namespace App\Livewire\Admin\Device;

use App\Models\DeviceSyncHistories;
use Livewire\Component;

class SyncHistory extends Component
{
    public function render()
    {
          $query = DeviceSyncHistories::query();
        return view('livewire.admin.device.sync-history',[
            'histories' => $query->paginate(10)
        ]);
    }
}
