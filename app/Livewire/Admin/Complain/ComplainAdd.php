<?php
namespace App\Livewire\Admin\Complain;

use App\Models\Branch;
use App\Models\Complain;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithFileUploads;

class ComplainAdd extends Component
{
    use WithFileUploads;

    public $isEditMode = false;

    public $branches      = [];
    public $departments   = [];
    public $employeesData = [];

    public $branch_id;
    public $employee_id;
    public $against_employee_id; // nullable
    public $subject;
    public $date;
    public $description;
    public $status    = 0;
    public $documents = [];

    public $oldDocument = [];

    protected $rules = [
        'branch_id'           => 'required|exists:branches,id',
        'employee_id'         => 'required|exists:employees,id',
        'against_employee_id' => 'nullable|exists:employees,id',
        'subject'             => 'required|string',
        'date'                => 'required|date',
        'description'         => 'nullable|string',
        'status'              => 'required|in:0,1,2',
        'documents'           => 'nullable|array',
        'documents.*'         => 'file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx|max:2048',
    ];

    public function mount($complainId = null)
    {
        $this->branches = Branch::where('status', 'active')
            ->whereHas('employees', function ($query) {
                $query->where('status', 'active'); // only active employees
            })
            ->pluck('name', 'id')
            ->prepend('Select Branch', '')
            ->toArray();

        $this->employeesData = []; // default empty until branch selected

        if ($complainId) {
            $this->isEditMode = true;
            $complain         = Complain::findOrFail($complainId);

            $this->branch_id           = $complain->branch_id;
            $this->employee_id         = $complain->employee_id;
            $this->against_employee_id = $complain->against_employee_id ?? null;
            $this->subject             = $complain->subject;
            $this->date                = $complain->date;
            $this->description         = $complain->description;
            $this->status              = $complain->status;
            $this->oldDocument         = $complain->documents ?? [];

            $this->loadEmployeesByBranch();
        }
    }

    // Load employees for selected branch
    public function updatedBranchId()
    {
        $this->employee_id         = null;
        $this->against_employee_id = null;
        $this->loadEmployeesByBranch();
    }

    private function loadEmployeesByBranch()
    {
        if ($this->branch_id) {
            $this->employeesData = Employee::where('branch_id', $this->branch_id)
                ->where('status', 1)
                ->get()
                ->mapWithKeys(fn($employee) => [$employee->id => $employee->full_name])
                ->prepend('Select Employee', '')
                ->toArray();
        } else {
            $this->employeesData = [];
        }
    }

    public function submitComplain()
    {
        $validated = $this->validate();

        // Handle multiple files
        $storedDocuments = [];
        if (! empty($this->documents)) {
            foreach ($this->documents as $file) {
                $storedDocuments[] = $file->store('complains', 'public');
            }
        }

        $validated['against_employee_id'] = $this->against_employee_id ?? null;

        $validated['documents'] = ! empty($storedDocuments) ? $storedDocuments : ($this->oldDocument ?? null);

        if ($this->isEditMode) {
            $complain = Complain::findOrFail($this->branch_id);
            $complain->update($validated);
        } else {
            Complain::create($validated);
        }

        flash()->success($this->isEditMode ? 'Complain updated successfully.' : 'Complain created successfully.');
        return redirect()->route('admin.complain.index');
    }

    public function render()
    {
        return view('livewire.admin.complain.complain-add');
    }
}
