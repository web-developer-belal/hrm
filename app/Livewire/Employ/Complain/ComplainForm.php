<?php
namespace App\Livewire\Employ\Complain;

use App\Models\Complain;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComplainForm extends Component
{
    use WithFileUploads;

    public $employee;

    #[Validate('required')]
    public $branch_id;

    #[Validate('required')]
    public $employee_id;

    #[Validate('nullable|exists:employees,id')]
    public $against_employee_id;

    #[Validate('required|string')]
    public $subject;

    #[Validate('required|date')]
    public $date;
    #[Validate('nullable|string')]
    public $description;

    public $employeesData = [];

    public $documents = [];

    protected function rules(): array
    {
        return [
            'documents'   => 'nullable|array',
            'documents.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
        ];
    }

    public function mount()
    {
        $this->employee = Auth::guard('employee')->user();

        $this->branch_id   = $this->employee->branch_id;
        $this->employee_id = $this->employee->id;

        $this->employeesData = Employee::where('id', '!=', $this->employee->id)
            ->where('branch_id', $this->employee->branch_id)
            ->get()
            ->mapWithKeys(fn($employee) => [
                $employee->id => $employee->full_name,
            ])
            ->prepend('Select an employee', '')
            ->toArray();
    }

    public function submitComplain()
    {
        $validated = $this->validate();

        $storedDocuments = [];

        // ✅ Store multiple documents
        if (! empty($this->documents)) {
            foreach ($this->documents as $file) {
                $storedDocuments[] = $file->store('complains', 'public');
            }
        }

        Complain::create([
            'branch_id'           => $validated['branch_id'],
            'employee_id'         => $validated['employee_id'],
            'against_employee_id' => $validated['against_employee_id'] ?? null,
            'subject'             => $validated['subject'],
            'date'                => $validated['date'],
            'documents'           => $storedDocuments ?: null, // JSON array
            'description'         => $validated['description'] ?? null,
            'status'              => 0,
        ]);

        flash()->success('Employee complain created successfully.');

        return redirect()->route('employee.complain');
    }

    public function render()
    {
        return view('livewire.employ.complain.complain-form');
    }
}
