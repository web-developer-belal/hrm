<?php

namespace App\Livewire\Employ\Resignation;

use App\Models\Resignation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ManageResignation extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';
    public $resignationId = null;
    public $selectedResignation = null;

    public function mount($resignation = null): void
    {
        if ($resignation) {
            $this->resignationId = (int) $resignation;
            $this->loadSelectedResignation();
        }
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    protected function loadSelectedResignation(): void
    {
        if (! $this->resignationId) {
            $this->selectedResignation = null;
            return;
        }

        $employeeId = Auth::guard('employee')->id();

        $this->selectedResignation = Resignation::query()
            ->where('employee_id', $employeeId)
            ->with('approver')
            ->findOrFail($this->resignationId);
    }

    public function render()
    {
        if ($this->resignationId) {
            return view('livewire.employ.resignation.manage-resignation', [
                'isDetails' => true,
                'resignation' => $this->selectedResignation,
                'resignations' => collect(),
            ]);
        }

        $employeeId = Auth::guard('employee')->id();

        $resignations = Resignation::query()
            ->where('employee_id', $employeeId)
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('reason', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate(10);

        return view('livewire.employ.resignation.manage-resignation', [
            'isDetails' => false,
            'resignation' => null,
            'resignations' => $resignations,
        ]);
    }
}
