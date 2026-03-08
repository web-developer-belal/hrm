<?php

namespace App\Livewire\Admin\Notice;

use App\Models\Notice;
use Livewire\Component;

class NoticeDetails extends Component
{
    public $notice;
    public function mount($notice)
    {
        $this->notice = Notice::findOrFail($notice)->load('branch', 'department', 'readers');
    }
    public function render()
    {
        return view('livewire.admin.notice.notice-details');
    }
}
