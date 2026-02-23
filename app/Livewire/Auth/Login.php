<?php
namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email='employee1@gmail.com';
    public $password='1234';

    public function login()
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        $credentials = [
            'email'    => $this->email,
            'password' => $this->password,
        ];

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->route('employee.dashboard');
        }

        flash()->error('Invalid credentials or inactive account.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('auth');
    }
}
