<?php

namespace App\Livewire\Admin\RolesPermission\Roles;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class RolesForm extends Component
{
    public $isEditMode = false;
    public $role;
    public $name;
    public $is_default = false;
    public $permissionMatrix = [];
    public $selectedPermissions = [];

    public function mount($role = null)
    {
        $this->permissionMatrix = User::permissionMatrix();

        if ($role) {
            $this->isEditMode = true;
            $this->role = Role::with('permissions')->findOrFail($role);
            $this->name = $this->role->name;
            $this->is_default = $this->role->is_default;
            $this->selectedPermissions = $this->role->permissions->pluck('permission')->values()->all();
        }
    }

    public function saveRole()
    {
        $availablePermissions = User::permissionNameArray();

        $validatedData = $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . ($this->isEditMode ? $this->role->id : 'NULL'),
            'is_default' => 'boolean',
            'selectedPermissions' => 'nullable|array',
            'selectedPermissions.*' => 'string|in:' . implode(',', $availablePermissions),
        ]);

        if ($this->isEditMode) {
            $this->role->update([
                'name' => $validatedData['name'],
                'is_default' => $validatedData['is_default'],
            ]);
            $savedRole = $this->role->fresh();
            flash()->success('Role updated successfully.');
        } else {
            $savedRole = Role::create([
                'name' => $validatedData['name'],
                'is_default' => $validatedData['is_default'],
            ]);
            flash()->success('Role created successfully.');
        }

        $savedRole->syncPermissions($this->selectedPermissions ?? []);

        return redirect()->route('admin.roles');
    }

    public function render()
    {
        return view('livewire.admin.roles-permission.roles.roles-form');
    }
}
