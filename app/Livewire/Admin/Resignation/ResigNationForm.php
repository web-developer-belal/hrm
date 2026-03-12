<?php
namespace App\Livewire\Admin\Resignation;

use App\Models\Employee;
use App\Models\Resignation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResigNationForm extends Component
{
    public $isEditMode = false;
    public $resignationModel;

    public $employee_id;
    public $subject = '';
    public $resignation_date;
    public $reason  = '';
    public $comment = '';
    public $status  = 'pending';

    public $employee_id_options = [];
    public $employee_id_search;

    protected $rules = [
        'employee_id'      => 'required|exists:employees,id',
        'subject'          => 'required|string|max:255',
        'resignation_date' => 'required|date',
        'reason'           => 'nullable|string|max:5000',
        'comment'          => 'nullable|string|max:2000',
        'status'           => 'required|in:pending,approved,rejected',
    ];

    public function mount($resignation = null): void
    {
        $this->loadEmployee();
        $this->resignation_date = now()->toDateString();

        if ($resignation) {
            $this->isEditMode       = true;
            $this->resignationModel = Resignation::findOrFail($resignation);

            $this->employee_id      = $this->resignationModel->employee_id;
            $this->subject          = $this->resignationModel->subject;
            $this->resignation_date = optional($this->resignationModel->resignation_date)->toDateString();
            $this->reason           = (string) $this->resignationModel->reason;
            $this->comment          = (string) $this->resignationModel->comment;
            $this->status           = $this->resignationModel->status;
        }
    }

    public function loadEmployee()
    {
        $this->employee_id_options = Employee::query()
            ->when($this->employee_id_search, fn($q) =>
                $q->where(function ($query) {
                    $query->where('first_name', 'like', '%' . $this->employee_id_search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->employee_id_search . '%')
                        ->orWhere('employee_code', 'like', '%' . $this->employee_id_search . '%');
                })
            )
            ->where('status', 1)
            ->orderBy('first_name')
            ->take(6)
            ->get()
            ->mapWithKeys(fn($employee) => [
                $employee->id => $employee->full_name . ' (' . $employee->employee_code . ')',
            ])
            ->toArray();
    }

    public function updatedEmployeeIdSearch()
    {
        $this->loadEmployee();
    }

    public function save()
    {
        $validated = $this->validate();

        $payload = [
            'employee_id'      => $validated['employee_id'],
            'subject'          => $validated['subject'],
            'resignation_date' => $validated['resignation_date'],
            'reason'           => $validated['reason'],
            'comment'          => $validated['comment'],
            'status'           => $validated['status'],
            'approver_by'      => $validated['status'] === 'pending' ? null : Auth::id(),
        ];

        if ($this->isEditMode) {
            $this->resignationModel->update($payload);
            flash()->success('Resignation updated successfully.');
        } else {
            Resignation::create($payload);
            flash()->success('Resignation created successfully.');
        }

        return redirect()->route('admin.resignations.index');
    }

    public function render()
    {
        return view('livewire.admin.resignation.resig-nation-form');
    }
}
