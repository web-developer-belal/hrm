<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'email',
        'password',
        'status',
        'photo',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public static function permissionActions(): array
    {
        return ['show', 'create', 'edit', 'delete'];
    }

    public static function permissionMatrix(): array
    {
        // don't need edit create delete permission for these modules
        $withOutCrud = ['dashboard', 'profile', 'activity-log','settings'];
        $modules = collect(Route::getRoutes()->getRoutesByName())
            ->keys()
            ->filter(fn ($name) => Str::startsWith($name, 'admin.'))
            ->map(function ($name) {
                $segments = explode('.', $name);
                return $segments[1] ?? null;
            })
            ->filter()
            ->reject(fn ($module) => in_array($module, ['logout', 'calender'], true))
            ->unique()
            ->sort()
            ->values();

        $permissions = [];

        foreach ($modules as $module) {
            $actions = in_array($module, $withOutCrud) ? ['show'] : self::permissionActions();
            foreach ($actions as $action) {
                $permissions[$module][$action] = "{$module}.{$action}";
            }
        }

        return $permissions;
    }

    public static function permissionNameArray(): array
    {
        return collect(self::permissionMatrix())
            ->flatMap(fn ($actions) => array_values($actions))
            ->values()
            ->all();
    }

    public function hasPermission($permission): bool
    {
        if (!$this->role) {
            return false;
        }

        if($this->isAdmin()) {
            return true;
        }

        // Check if user's role has this permission
        return $this->role->hasPermission($permission);
    }

    public function isAdmin(): bool
    {
        return $this->role && $this->role->name === 'Admin';
    }

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
