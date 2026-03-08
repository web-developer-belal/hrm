<?php

namespace App\Livewire\Admin\Profile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageProfile extends Component
{
    use WithFileUploads;
    public $user;

    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $address;
    public $photo;
    public $new_password;
    public $new_password_confirmation;
    public $old_password;
    public $photo_path;

    public function mount()
    {
        $this->user = Auth::user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone_number = $this->user->phone_number;
        $this->address = $this->user->address;
        $this->photo_path = customAsset($this->user->photo,true,'user');
    }

    public function updateProfile()
    {
        $this->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|max:2048',
            'new_password' => 'nullable|string|min:6|confirmed',
            'old_password' => 'nullable|required_with:new_password|string|min:6',
        ]);

        $this->user->first_name = $this->first_name;
        $this->user->last_name = $this->last_name;
        $this->user->email = $this->email;
        $this->user->phone_number = $this->phone_number;
        $this->user->address = $this->address;
        if ($this->photo) {
            $this->user->photo = storeImage($this->photo, 'profile_photos');
        }
        if ($this->new_password) {
                if (!Hash::check($this->old_password, $this->user->password)) {
                    $this->addError('old_password', 'The old password is incorrect.');
                    return;
                }
            $this->user->password = Hash::make($this->new_password);
        }
        $this->user->save();

        flash()->success('Profile updated successfully.');
    }

    public function render()
    {
        return view('livewire.admin.profile.manage-profile');
    }
}
