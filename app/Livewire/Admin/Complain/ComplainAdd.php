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
    public $complainId;

    public $branch_id;
    public $employee_id;
    public $against_employee_id;
    public $subject;
    public $date;
    public $description;
    public $status      = 0;
    public $documents   = [];
    public $oldDocument = [];

    // Searchable Selects
    public $branch_id_options = [];
    public $branch_id_search;

    public $employee_id_options = [];
    public $employee_id_search;

    public $against_employee_id_options = [];
    public $against_employee_id_search;

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
        $this->loadBranchOptions();

        if ($complainId) {
            $this->isEditMode = true;
            $this->complainId = Complain::findOrFail($complainId);

            $this->branch_id           = $this->complainId->branch_id;
            $this->employee_id         = $this->complainId->employee_id;
            $this->against_employee_id = $this->complainId->against_employee_id;
            $this->subject             = $this->complainId->subject;
            $this->date                = $this->complainId->date->format('Y-m-d');
            $this->description         = $this->complainId->description;
            $this->status              = $this->complainId->status;
            $this->oldDocument         = $this->complainId->documents ?? [];

            $this->loadEmployeeOptions();
        }
    }

    /* ---------------- Branch ---------------- */

    protected function loadBranchOptions()
    {
        $this->branch_id_options = Branch::with('employee')->whereHas('employees')->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', '%' . $this->branch_id_search . '%')
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    public function documentsRemoveFile($path){
        deleteImage($path);
        flash()->success('File removed successfully.');
    }

    public function updatedBranchIdSearch()
    {
        $this->loadBranchOptions();
    }

    public function updatedBranchId()
    {
        $this->employee_id         = null;
        $this->against_employee_id = null;

        $this->employee_id_options         = [];
        $this->against_employee_id_options = [];

        $this->loadEmployeeOptions();
    }

    /* ---------------- Employees ---------------- */

    protected function loadEmployeeOptions()
    {
        if (! $this->branch_id) {
            return;
        }

        $employees = Employee::where('branch_id', $this->branch_id)
            ->where('status', 1)
            ->when($this->employee_id_search || $this->against_employee_id_search, function ($q) {
                $search = $this->employee_id_search ?: $this->against_employee_id_search;
                $q->where(function ($sub) use ($search) {
                    $sub->where('first_name', 'like', '%' . $search . '%')
                        ->orWhere('last_name', 'like', '%' . $search . '%')
                        ->orWhere('employee_code', 'like', '%' . $search . '%');
                });
            })
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($emp) => [$emp->id => $emp->full_name])
            ->toArray();

        $this->employee_id_options         = $employees;
        $this->against_employee_id_options = $employees;
    }

    public function updatedEmployeeIdSearch()
    {
        $this->loadEmployeeOptions();
    }

    public function updatedAgainstEmployeeIdSearch()
    {
        $this->loadEmployeeOptions();
    }

    /* ---------------- Submit ---------------- */

    public function submitComplain()
    {
        $validated = $this->validate();

        $storedDocuments = [];

        if (! empty($this->documents)) {
            foreach ($this->documents as $file) {
                $storedDocuments[] = $file->store('complains', 'public');
            }
        }

        $validated['against_employee_id'] = $this->against_employee_id ?? null;

        $validated['documents'] = ! empty($storedDocuments)
            ? $storedDocuments
            : ($this->oldDocument ?? null);

        if ($this->isEditMode) {

            $this->complainId->update($validated);

        } else {

            Complain::create($validated);
        }

        flash()->success(
            $this->isEditMode
                ? 'Complain updated successfully.'
                : 'Complain created successfully.'
        );

        return redirect()->route('admin.complain.index');
    }

    public function render()
    {
        return view('livewire.admin.complain.complain-add');
    }
}
