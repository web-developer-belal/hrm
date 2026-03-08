<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function syncPermissions(array $permissions): void
    {
        $allowedPermissions = User::permissionNameArray();

        $permissions = collect($permissions)
            ->filter(fn ($permission) => in_array($permission, $allowedPermissions, true))
            ->unique()
            ->values();

        $this->permissions()->delete();

        if ($permissions->isEmpty()) {
            return;
        }

        $this->permissions()->createMany(
            $permissions->map(fn ($permission) => ['permission' => $permission])->all()
        );
    }

    public function hasPermission($permission): bool
    {
        return $this->permissions()->where('permission', $permission)->exists();
    }
}
