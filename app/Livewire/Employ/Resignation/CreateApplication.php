<?php

namespace App\Livewire\Employ\Resignation;

use App\Models\Resignation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateApplication extends Component
{
    public $subject = '';
    public $resignation_date;
    public $reason = '';

    protected $rules = [
        'subject' => 'required|string|max:255',
        'resignation_date' => 'required|date|after_or_equal:today',
        'reason' => 'nullable|string|max:5000',
    ];

    public function mount(): void
    {
        $this->resignation_date = now()->toDateString();
    }

    public function save()
    {
        $this->validate();

        $employee = Auth::guard('employee')->user();

        Resignation::create([
            'employee_id' => $employee->id,
            'subject' => $this->subject,
            'resignation_date' => $this->resignation_date,
            'reason' => $this->reason,
            'status' => 'pending',
        ]);

        flash()->success('Resignation application submitted successfully.');

        return redirect()->route('employee.resignations.index');
    }

    public function render()
    {
        return view('livewire.employ.resignation.create-application');
    }
}
