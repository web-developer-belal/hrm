<?php
namespace App\Livewire\Employ;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $employee;

    public function mount()
    {
        $this->employee = Auth::guard('employee')
            ->user();
    }

    public function render()
    {
        return view('livewire.employ.dashboard');
    }
}
