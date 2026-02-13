<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeTransferRequest extends FormRequest
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
        return [
            'employee_id' => 'required|exists:employees,id',
            'form_branch_id'      => 'required|exists:branches,id',
            'form_department_id'  => 'required|exists:departments,id',
            'to_branch_id'      => 'required|exists:branches,id',
            'to_department_id'  => 'required|exists:departments,id',
            'note'=>'string|nullable',
            'status'=> 'required|in:0,1',
            // 'approved_by'=>'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'employee_id.required'    => 'Select Employee.',
            'selectedEmployee.exists'      => 'The selected Employee does not exist.',

            'to_branch_id.required'    => 'Select To Branch.',
            'to_branch_id.exists'      => 'The selected To Branch does not exist.',
            'form_department_id.required'    => 'Select From Department.',
            'form_department_id.exists'      => 'The selected From Department does not exist.',
            'to_department_id.required'    => 'Select To Department.',
            'to_department_id.exists'      => 'The selected To Department does not exist.',
        ];
    }
}
