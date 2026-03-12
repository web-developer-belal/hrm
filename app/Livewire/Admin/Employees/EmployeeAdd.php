<?php
namespace App\Livewire\Admin\Employees;

use App\Http\Requests\StoreEmployeeRequest;
use App\Mail\WelcomeEmployee;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SalaryTemplate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeAdd extends Component
{
    use WithFileUploads;

    public $isEditMode = false;
    public $emp;
    public $employee_id;
    public $isInitializing = true;

    // Form fields
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $gender = 'male';
    public $contact_number;
    public $alternative_phone_number;
    public $local_address;
    public $permanent_address;
    public $description;
    public $employee_code;
    public $branch_id;
    public $department_id;
    public $designation_id;
    public $shift_id;
    public $joining_date;
    public $workspace;
    public $supervisor_id;
    public $bank_name;
    public $routing_number;
    public $account_holder_name;
    public $bank_account_type;
    public $account_number;
    public $bank_notes;
    public $status = 0;
    public $email;
    public $mfs_account;

    public $password = '123456';

    // File uploads
    #[Validate('image|max:1024')]
    public $photo;
    public $oldPhoto;

    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $resume;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $offer_letter;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $joining_letter;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $contract_agreement;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $id_proof;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $checkbook;

    // Dropdowns & search
    public $branch_id_options = [], $branch_id_search;
    public $department_id_options = [], $department_id_search;
    public $designation_id_options = [], $designation_id_search;

    public function mount($emp = null)
    {
        $this->loadBranchOptions();
        $this->password = rand(100000, 999999);
        if ($emp) {
            $this->isEditMode = true;
            $emp              = Employee::findOrFail($emp);

            // dd($emp->toArray());
            $this->emp                      = $emp;
            $this->employee_id              = $emp->id;
            $this->first_name               = $emp->first_name;
            $this->last_name                = $emp->last_name;
            $this->date_of_birth            = $emp->date_of_birth?->format('Y-m-d');
            $this->gender                   = $emp->gender;
            $this->contact_number           = $emp->contact_number;
            $this->alternative_phone_number = $emp->alternative_phone_number;
            $this->local_address            = $emp->local_address;
            $this->permanent_address        = $emp->permanent_address;
            $this->description              = $emp->description;
            $this->employee_code            = $emp->employee_code;
            $this->branch_id                = $emp->branch_id;
            $this->department_id            = $emp->department_id;
            $this->designation_id           = $emp->designation_id;
            $this->shift_id                 = $emp->shift_id;
            $this->joining_date             = $emp->joining_date?->format('Y-m-d');
            $this->workspace                = $emp->workspace;
            $this->supervisor_id            = $emp->supervisor_id;
            $this->bank_name                = $emp->bank_name;
            $this->routing_number           = $emp->routing_number;
            $this->account_holder_name      = $emp->account_holder_name;
            $this->bank_account_type        = $emp->bank_account_type;
            $this->account_number           = $emp->account_number;
            $this->bank_notes               = $emp->bank_notes;
            $this->oldPhoto                 = $emp->photo;
            $this->status                   = $emp->status;
            $this->email                    = $emp->email;
            $this->mfs_account              = $emp->mfs_account;
            $this->loadDepartmentOptions();
            $this->loadDesignationOptions();
        }

        $this->isInitializing = false;
    }

    // Searchable dropdown loaders
    protected function loadBranchOptions()
    {
        $this->branch_id_options = Branch::query()
            ->whereHas('departments')
            ->where('status', 'active')
            ->when($this->branch_id_search, fn($q) =>
                $q->where('name', 'like', "%{$this->branch_id_search}%")
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();
    }

    protected function loadDepartmentOptions()
    {
        $query = Department::query()->whereHas('branch')->where('status', 'active');

        if ($this->branch_id) {
            $query->where('branch_id', $this->branch_id);
        }

        $options = $query
            ->when($this->department_id_search, fn($q) =>
                $q->where('name', 'like', "%{$this->department_id_search}%")
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();

        // Ensure selected value is included
        if ($this->department_id && ! isset($options[$this->department_id])) {
            $selected = Department::find($this->department_id);
            if ($selected) {
                $options[$this->department_id] = $selected->name;
            }
        }

        $this->department_id_options = $options;
    }

    protected function loadDesignationOptions()
    {
        if (! $this->department_id) {
            $this->designation_id_options = [];
            return;
        }

        $options = Designation::query()
            ->where('status', 'active')
            ->where('department_id', $this->department_id)
            ->when($this->designation_id_search, fn($q) =>
                $q->where('name', 'like', "%{$this->designation_id_search}%")
            )
            ->limit(5)
            ->pluck('name', 'id')
            ->toArray();

        // Ensure selected value is included
        if ($this->designation_id && ! isset($options[$this->designation_id])) {
            $selected = Designation::find($this->designation_id);
            if ($selected) {
                $options[$this->designation_id] = $selected->name;
            }
        }

        $this->designation_id_options = $options;
    }

    // Live updating searches
    public function updatedBranchIdSearch()
    {$this->loadBranchOptions();}
    public function updatedDepartmentIdSearch()
    {$this->loadDepartmentOptions();}
    public function updatedDesignationIdSearch()
    {$this->loadDesignationOptions();}

    public function updatedBranchId()
    {
        if (! $this->isInitializing) {
            $this->department_id  = null;
            $this->designation_id = null;
        }
        $this->loadDepartmentOptions();
    }

    public function updatedDepartmentId()
    {
        if (! $this->isInitializing) {
            $this->designation_id = null;
        }
        $this->loadDesignationOptions();
    }

    // Save employee
    public function saveEmployee()
    {
        $data             = $this->validate((new StoreEmployeeRequest)->rules(), (new StoreEmployeeRequest)->messages());
        $data['password'] = Hash::make($this->password);

        if ($this->isEditMode) {
            $emp = Employee::findOrFail($this->employee_id);
            $emp->update($data);
        } else {
            $emp = Employee::create($data);

            $checkSalaryTemplate = SalaryTemplate::where('designation_id', $this->designation_id)->first();
            if ($checkSalaryTemplate) {
                $emp->salaryData()->create([
                    'branch_id'                => $this->branch_id,
                    'basic_salary'             => $checkSalaryTemplate->basic_salary,
                    'house_rent'               => $checkSalaryTemplate->house_rent,
                    'medical_allowance'        => $checkSalaryTemplate->medical_allowance,
                    'dear_allowance'           => $checkSalaryTemplate->dear_allowance,
                    'transport_allowance'      => $checkSalaryTemplate->transport_allowance,
                    'pf_employer_contribution' => $checkSalaryTemplate->pf_employer_contribution,
                    'other_allowance'          => $checkSalaryTemplate->other_allowance,
                    'pf_employee_contribution' => $checkSalaryTemplate->pf_employee_contribution,
                    'welfare_contribution'     => $checkSalaryTemplate->welfare_contribution,
                    'tax_deduction'            => $checkSalaryTemplate->tax_deduction,
                ]);
            }
            // send in queue
            Mail::to($emp->email)->queue(new WelcomeEmployee($emp, $this->password));
        }

        $this->handleFileUploads($emp);

        flash()->success($this->isEditMode ? 'Employee updated successfully.' : 'Employee created successfully.');
        return redirect()->route('admin.employees.index');
    }

    private function handleFileUploads(Employee $emp)
    {
        $fileUpdates = [];

        if ($this->photo) {
            if ($this->isEditMode && $emp->photo) {
                deleteImage($emp->photo);
            }

            $fileUpdates['photo'] = storeImage($this->photo, 'employees/photos', 300, 300, 'webp');
        }

        $documents = [
            'resume'             => 'resume-emps',
            'offer_letter'       => 'offer_letter-emps',
            'joining_letter'     => 'joining_letter-emps',
            'contract_agreement' => 'contract_agreement-emps',
            'id_proof'           => 'id_proof-emps',
            'checkbook'          => 'checkbook-emps',
        ];

        foreach ($documents as $field => $prefix) {
            if ($this->{$field}) {
                if ($this->isEditMode && $emp->{$field}) {
                    deleteDocument($emp->{$field});
                }

                $result              = storeDocument($this->{$field}, 'employees/documents', $prefix);
                $fileUpdates[$field] = $result['path'];
            }
        }

        if (! empty($fileUpdates)) {
            $emp->update($fileUpdates);
        }

    }

    // File removal methods
    public function photoRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteImage($path);
            $this->emp->update(['photo' => null]);
            $this->oldPhoto = null;
        }
    }

    public function resumeRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['resume' => null]);
        }
    }

    public function offer_letterRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['offer_letter' => null]);
        }
    }

    public function joining_letterRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['joining_letter' => null]);
        }
    }

    public function contract_agreementRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['contract_agreement' => null]);
        }
    }

    public function id_proofRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['id_proof' => null]);
        }
    }

    public function checkbookRemoveFile($path)
    {
        if ($this->isEditMode && $this->emp) {
            deleteDocument($path);
            $this->emp->update(['checkbook' => null]);
        }
    }

    public function render()
    {
        return view('livewire.admin.employees.employee-add');
    }
}
