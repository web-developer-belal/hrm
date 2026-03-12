<?php

namespace App\Livewire\Admin\Resignation;

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
    public $adminComment = '';

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

        $this->selectedResignation = Resignation::with(['employee', 'approver'])->findOrFail($this->resignationId);
        $this->adminComment = (string) ($this->selectedResignation->comment ?? '');
    }

    public function updateStatus(string $status): void
    {
        if (! in_array($status, ['approved', 'rejected'], true)) {
            flash()->error('Invalid status selected.');
            return;
        }

        if (! $this->selectedResignation) {
            flash()->error('Resignation not found.');
            return;
        }

        $this->selectedResignation->update([
            'status' => $status,
            'comment' => $this->adminComment,
            'approver_by' => Auth::id(),
        ]);

        $this->loadSelectedResignation();
        flash()->success('Resignation status updated successfully.');
    }

    public function deleteResignation($id): void
    {
        Resignation::findOrFail($id)->delete();
        flash()->success('Resignation deleted successfully.');
    }

    public function render()
    {
        if ($this->resignationId) {
            return view('livewire.admin.resignation.manage-resignation', [
                'isDetails' => true,
                'resignation' => $this->selectedResignation,
                'resignations' => collect(),
            ]);
        }

        $resignations = Resignation::query()
            ->with('employee')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('subject', 'like', '%' . $this->search . '%')
                        ->orWhere('reason', 'like', '%' . $this->search . '%')
                        ->orWhereHas('employee', function ($emp) {
                            $emp->where('first_name', 'like', '%' . $this->search . '%')
                                ->orWhere('last_name', 'like', '%' . $this->search . '%')
                                ->orWhere('employee_code', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->latest()
            ->paginate(12);

        return view('livewire.admin.resignation.manage-resignation', [
            'isDetails' => false,
            'resignation' => null,
            'resignations' => $resignations,
        ]);
    }
}
