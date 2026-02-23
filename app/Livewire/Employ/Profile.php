<?php

namespace App\Livewire\Employ;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $contact_number;
    public $local_address;
    public $password;
    public $password_confirmation;
    public $photo;

    public function mount()
    {
        $user = Auth::guard('employee')->user();

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->contact_number = $user->contact_number;
        $this->local_address = $user->local_address;
    }

    public function save()
    {
        $user = Auth::guard('employee')->user();

        $validated = $this->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:20',
            'local_address'      => 'nullable|string|max:255',
            'photo'        => 'nullable|image|max:2048',
            'password'     => 'nullable|min:6|confirmed',
        ]);

        // Handle photo upload
        if ($this->photo) {
            $photoPath = storeImage($this->photo,'employee/profile');
            $validated['photo'] = $photoPath;
        }

        // Hash password only if entered
        if (!empty($this->password)) {
            $validated['password'] = Hash::make($this->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        $this->reset('photo');
        flash()->success('Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.employ.profile');
    }
}
