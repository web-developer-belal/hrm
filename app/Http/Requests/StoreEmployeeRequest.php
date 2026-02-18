<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // $employeeId = $this->route(param: 'emp');
        // dd($employeeId);
        return [
            'branch_id'      => 'required|exists:branches,id',
            'department_id'  => 'required|exists:departments,id',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'required',
            'contact_number' => 'required',
            'alternative_phone_number' => 'required',
            'local_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'description' => 'nullable',
            'employee_code' =>'required',
            // 'employee_code' => ['required','string',Rule::unique('employees', 'employee_code')->ignore($employee)],
            'designation_id' => 'required',
            'joining_date' => 'required|date',
            'workspace' => 'nullable',
            'supervisor_id' => 'nullable',
            'bank_name' => 'nullable',
            'routing_number' => 'nullable',
            'account_holder_name' => 'nullable',
            'bank_account_type' => 'nullable',
            'account_number' => 'nullable',
            'bank_notes' => 'nullable',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required'           => 'First name is required.',
            'branch_id.required'      => 'Branch selection is required.',
            'employee_code.required'      => 'Employee Code is required & unique.',
            'branch_id.exists'        => 'Selected branch does not exist.',
            'department_id.required'  => 'Department selection is required.',
            'gender.required'  => 'Gender selection is required.',
            'contact_number.required'  => 'Contact number is required.',
            'alternative_phone_number.required'  => 'Alternative contact number is required.',
            'department_id.exists'    => 'Selected department does not exist.',
            'designation_id.required'    => 'Designation Selection is required.',
            'joining_date.required'     => 'Joining Date is required.',
            'joining_date.date'         => 'Joining Date must be a valid date.',
            'photo'                     => 'Photo must be in image and its not bigger then 2mb',
            'local_address.required'         => 'Present Address is required.',
            'permanent_address.required'         => 'Permanent Address is required.',
            'status.required'         => 'Status is required.',
        ];
    }
}
