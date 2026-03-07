<?php

namespace App\Livewire\Admin\RolesPermission;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserForm extends Component
{
    use WithFileUploads;
    public $isEditMode = false;
    public $user;
    public $photo;
    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $address;
    public $password;
    public $role = 'admin';
    public $status = 'active';

    public function mount($userId = null)
    {
        if ($userId) {
            $this->isEditMode = true;
            $this->user = User::findOrFail($userId);
            $this->first_name = $this->user->first_name;
            $this->last_name = $this->user->last_name;
            $this->email = $this->user->email;
            $this->phone_number = $this->user->phone_number;
            $this->address = $this->user->address;
            $this->role = $this->user->role;
            $this->status = $this->user->status;
        }
    }
    
    public function saveUser()
    {
        $validatedData = $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . ($this->isEditMode ? $this->user->id : 'NULL'),
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => $this->isEditMode ? 'nullable|string|min:6' : 'required|string|min:6',
            'role' => 'required|in:admin,hr,manager',
            'status' => 'required|in:active,inactive',
        ]);

        if ($this->photo) {
            $validatedData['photo'] =storeImage($this->photo, 'users');
        }

        if ($this->isEditMode) {
            if ($validatedData['password'] === null) {
                unset($validatedData['password']);
            } else {
                $validatedData['password'] = Hash::make($validatedData['password']);
            }
            $this->user->update($validatedData);
            flash()->success('User updated successfully.');
        } else {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData);
            flash()->success('User created successfully.');
        }

        return redirect()->route('admin.users');
    }

    public function render()
    {
        return view('livewire.admin.roles-permission.user-form');
    }
}
