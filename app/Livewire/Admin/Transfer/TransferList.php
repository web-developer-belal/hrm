<?php

namespace App\Livewire\Admin\Transfer;

use Livewire\Component;
use App\Models\Transfer;
use Livewire\WithPagination;

class TransferList extends Component
{
 use WithPagination;
    public function render()
    {
        $query = Transfer::query();

        return view('livewire.admin.transfer.transfer-list',[
            'tranasfers' => $query->paginate(10),
        ]);
    }
}
