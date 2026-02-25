<?php

namespace App\Livewire\Admin\Complain;

use App\Models\Complain;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ComplainList extends Component
{

    public bool $Modalshow = false;
    public $complain;

    #[Validate('required')]
    public $status;
    public $remarks;

    public function checkedComplain($id)
    {
        $this->Modalshow = true;
        $this->complain = Complain::find($id);
    }
    public function closeModal()
    {
        $this->Modalshow = false;
        $this->resetErrorBag();
    }

    public function resolveComplain()
    {
        $this->complain->update([
            'status'=>$this->status,
            'remarks'=>$this->remarks,
        ]);
        $this->Modalshow = false;
         $this->resetErrorBag();
    }
    public function render()
    {
        $query = Complain::query();
        // $query->with(['complainant','againstEmp','branch']);
        return view('livewire.admin.complain.complain-list',[
            'complains' => $query->paginate(10),
        ]);
    }
}
