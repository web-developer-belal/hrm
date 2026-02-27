<?php

namespace App\Livewire\Admin\Employees;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\SalaryTemplate;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmployeeAdd extends Component
{
    use WithFileUploads;
    public $isEditMode = false;
    public $branches = [];
    public $departments = [];
    public $designations = [];
    public $emp;
    public $employee_id;
    public $existingPhoto;
    #[Validate('image|max:1024')]
    public $photo;
    public $first_name;
    public $last_name;
    public $date_of_birth;
    public $gender;
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
    public $oldPhoto;
    public $status;

    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $resume;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $offer_letter;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $joining_letter;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $contract_agreement;
    #[Validate('nullable|file|mimes:jpeg,png,webp,pdf,doc,docx|max:10240')]
    public $Id_proof;




    public function mount($emp = null)
    {
        $this->branches = Branch::where('status', 'active')->pluck('name', 'id')->prepend('Select Branch', '')->toArray();
        $this->departments = Department::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();
        $this->designations = Designation::where('status', 'active')->pluck('name', 'id')->prepend('Select Department', '')->toArray();

        if ($emp) {

            $this->isEditMode = true;

            $emp = Employee::findorfail($emp);
            $this->emp = $emp;
            $this->employee_id= $emp->id;
            $this->first_name = $emp->first_name;
            $this->last_name = $emp->last_name;
            $this->date_of_birth = $emp->date_of_birth;
            $this->gender = $emp->gender;
            $this->contact_number = $emp->contact_number;
            $this->alternative_phone_number = $emp->alternative_phone_number;
            $this->local_address = $emp->local_address;
            $this->permanent_address = $emp->permanent_address;
            $this->description = $emp->description;
            $this->employee_code = $emp->employee_code;
            $this->branch_id = $emp->branch_id;
            $this->department_id = $emp->department_id;
            $this->designation_id = $emp->designation_id;
            $this->shift_id = $emp->shift_id;
            $this->joining_date = $emp->joining_date;
            $this->workspace = $emp->workspace;
            $this->supervisor_id = $emp->supervisor_id;
            $this->bank_name = $emp->bank_name;
            $this->routing_number = $emp->routing_number;
            $this->account_holder_name = $emp->account_holder_name;
            $this->bank_account_type = $emp->bank_account_type;
            $this->account_number = $emp->account_number;
            $this->bank_notes = $emp->bank_notes;
            $this->oldPhoto = $emp->photo;
            $this->status = $emp->status;

        }
    }

    public function saveEmployee()
    {


        $data = $this->validate((new StoreEmployeeRequest)->rules(), (new StoreEmployeeRequest)->messages());

        if ($this->isEditMode) {
        $emp = Employee::findOrFail($this->employee_id);
        $emp->update($data);
    } else {
        $emp = Employee::create($data);
        $checkSalaryTeplate = SalaryTemplate::where('designation_id', $this->designation_id)->first();

        if ($checkSalaryTeplate) {
            $emp->salaryData()->create([
                'branch_id' => $this->branch_id,
                'basic_salary' => $checkSalaryTeplate->basic_salary,
                'house_rent' => $checkSalaryTeplate->house_rent,
                'medical_allowance' => $checkSalaryTeplate->medical_allowance,
                'dear_allowance' => $checkSalaryTeplate->dear_allowance,
                'transport_allowance' => $checkSalaryTeplate->transport_allowance,
                'pf_employer_contribution' => $checkSalaryTeplate->pf_employer_contribution,
                'other_allowance' => $checkSalaryTeplate->other_allowance,
                'pf_employee_contribution' => $checkSalaryTeplate->pf_employee_contribution,
                'welfare_contribution' => $checkSalaryTeplate->welfare_contribution,
                'tax_deduction' => $checkSalaryTeplate->tax_deduction,
            ]);

        }
    }

      // Handle file uploads
    $this->handleFileUploads($emp);

        // if( $this->isEditMode == true)
        // {

        //     $emp = Employee::findorfail($this->employee_id);

        //     $emp->update($data);

        // if ($this->photo) {
        //     deleteImage($emp->photo);
        // }

        // if ($this->resume) {
        // deleteDocument($emp->resume);
        // }
        // if ($this->offer_letter) {
        // deleteDocument($emp->offer_letter);
        // }
        // if ($this->joining_letter) {
        // deleteDocument($emp->joining_letter);
        // }
        // if ($this->contract_agreement) {
        // deleteDocument($emp->contract_agreement);
        // }
        // if ($this->Id_proof) {
        // deleteDocument($emp->Id_proof);
        // }

        //     $imagePath = storeImage($this->photo, 'products', 300, 300);

        //     $resume = storeDocument($this->resume, 'documents', 'resume-emps');
        //     $offerLetter = storeDocument($this->offer_letter, 'documents', 'offer_letter-emps');
        //     $joinginLetter = storeDocument($this->joining_letter, 'documents', 'joining_letter-emps');
        //     $contractAgreement = storeDocument($this->contract_agreement, 'documents', 'contract_agreement-emps');
        //     $idProof = storeDocument($this->Id_proof, 'documents', 'contract_agreement-emps');

        //     $emp->update([
        //         'photo' => $imagePath,
        //         'resume' => $resume['path'] ?? '',
        //         'offer_letter' => $offerLetter['path'] ?? '',
        //         'joining_letter' => $joinginLetter['path'] ?? '',
        //         'contract_agreement' => $contractAgreement['path'] ?? '',
        //         'Id_proof' => $idProof['path'] ?? '',
        //         ]);
        // }else{
        //    $storeEmployee= Employee::create($data);
        //     $imagePath = storeImage(
        //         $this->photo,
        //         'products',
        //         300,
        //         300,
        //         'webp'
        //     );
        //     $resume = storeDocument($this->resume, 'documents', 'resume-emps');
        //     $offerLetter = storeDocument($this->offer_letter, 'documents', 'offer_letter-emps');
        //     $joinginLetter = storeDocument($this->joining_letter, 'documents', 'joining_letter-emps');
        //     $contractAgreement = storeDocument($this->contract_agreement, 'documents', 'contract_agreement-emps');
        //     $idProof = storeDocument($this->Id_proof, 'documents', 'contract_agreement-emps');

        //     $storeEmployee->update([
        //         'photo' => $imagePath,
        //         'resume' => $resume['path'] ?? '',
        //         'offer_letter' => $offerLetter['path'] ?? '',
        //         'joining_letter' => $joinginLetter['path'] ?? '',
        //         'contract_agreement' => $contractAgreement['path'] ?? '',
        //         'Id_proof' => $idProof['path'] ?? '',
        //     ]);
        // }


        flash()->success($this->isEditMode ? 'Employee updated successfully.' : 'Employee created successfully.');
        return redirect()->route('admin.employees.index');
    }

    public function render()
    {
        return view('livewire.admin.employees.employee-add');
    }



    private function handleFileUploads(Employee $emp)
{
    $fileUpdates = [];

    // Handle photo
    if ($this->photo) {
        if ($this->isEditMode && $emp->photo) {
            deleteImage($emp->photo);
        }
        $fileUpdates['photo'] = storeImage($this->photo, 'employees/photos', 300, 300, 'webp');
    }

    // Handle documents
    $documents = [
        'resume' => 'resume-emps',
        'offer_letter' => 'offer_letter-emps',
        'joining_letter' => 'joining_letter-emps',
        'contract_agreement' => 'contract_agreement-emps',
        'Id_proof' => 'id_proof-emps',
    ];

    foreach ($documents as $field => $prefix) {
        if ($this->{$field}) {
            if ($this->isEditMode && $emp->{$field}) {
                deleteDocument($emp->{$field});
            }
            $result = storeDocument($this->{$field}, 'employees/documents', $prefix);
            $fileUpdates[$field] = $result['path'];
        }
    }

    if (!empty($fileUpdates)) {
        $emp->update($fileUpdates);
    }
}

}
