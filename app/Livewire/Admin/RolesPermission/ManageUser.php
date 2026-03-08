<?php
namespace App\Livewire\Admin\RolesPermission;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ManageUser extends Component
{
    public $search = '';
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function statusToggle($userId)
    {
        $user         = User::findOrFail($userId);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        flash()->success('User status updated successfully.');
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        flash()->success('User deleted successfully.');
    }
    public function render()
    {
        $users = User::with('role.permissions')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })->where('id', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.admin.roles-permission.manage-user', compact('users'));
    }
}
