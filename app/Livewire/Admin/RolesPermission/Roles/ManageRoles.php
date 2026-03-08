<?php

namespace App\Livewire\Admin\RolesPermission\Roles;

use App\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;

class ManageRoles extends Component
{
    use WithPagination;

    public $search = '';

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteRole($roleId)
    {
        $role = Role::findOrFail($roleId);

        // Prevent deletion of default role
        if ($role->is_default) {
            flash()->error('Cannot delete default role.');
            return;
        }

        // Check if role has users
        if ($role->users()->count() > 0) {
            flash()->error('Cannot delete role that has assigned users.');
            return;
        }

        $role->delete();
        flash()->success('Role deleted successfully.');
    }

    public function render()
    {
        $roles = Role::withCount('users')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.roles-permission.roles.manage-roles', [
            'roles' => $roles,
        ]);
    }
}
