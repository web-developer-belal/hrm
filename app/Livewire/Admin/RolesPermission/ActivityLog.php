<?php

namespace App\Livewire\Admin\RolesPermission;

use App\Models\ActivityLog as ModelsActivityLog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityLog extends Component
{
    use WithPagination;

    public $users = [];
    public $search = '';
    public $user = '';
    public $perPage = 10;
    public $event = '';

    public $events = [
        'created' => 'Created',
        'updated' => 'Updated',
        'deleted' => 'Deleted',
        'login' => 'Login',
        'logout' => 'Logout',
        'failed_login' => 'Failed Login',
    ];

    public function mount()
    {
        $this->users = User::get()->mapWithKeys(function ($item) {
            return [$item->id => $item->full_name];
        })->toArray();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingUser(): void
    {
        $this->resetPage();
    }

    public function updatingEvent(): void
    {
        $this->resetPage();
    }

    public function deleteLog(int $logId): void
    {
        ModelsActivityLog::whereKey($logId)->delete();
        $this->resetPage();
    }

    public function render()
    {
        $search = trim((string) $this->search);

        $logs = ModelsActivityLog::with('user')
            ->when($this->user, function ($query) {
                $query->where('user_id', $this->user);
            })
            ->when($this->event, function ($query) {
                $query->where('event', $this->event);
            })
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('description', 'like', "%{$search}%")
                        ->orWhere('subject_type', 'like', "%{$search}%")
                        ->orWhere('event', 'like', "%{$search}%")
                        ->orWhere('route_name', 'like', "%{$search}%")
                        ->orWhere('url', 'like', "%{$search}%")
                        ->orWhereRaw('CAST(old_values AS CHAR) LIKE ?', ["%{$search}%"])
                        ->orWhereRaw('CAST(new_values AS CHAR) LIKE ?', ["%{$search}%"])
                        ->orWhereHas('user', function ($subQuery) use ($search) {
                            $subQuery->where('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('id')
            ->paginate($this->perPage);

        return view('livewire.admin.roles-permission.activity-log', compact('logs'));
    }
}
