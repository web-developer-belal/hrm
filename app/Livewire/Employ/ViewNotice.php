<?php

namespace App\Livewire\Employ;

use App\Models\Notice;
use Livewire\Component;

class ViewNotice extends Component
{
    public $notice;
    public function mount(Notice $notice){
        $this->notice=$notice;
    }
    public function render()
    {
        return view('livewire.employ.view-notice');
    }
}
