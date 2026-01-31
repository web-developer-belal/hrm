<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RosterEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'roster_id'   => 'required|exists:rosters,id',
            'employee_ids'=> 'required|array',
            'employee_ids.*' => 'exists:employees,id',
        ];
    }

    public function messages(): array
    {
        return [
            'roster_id.required'    => 'Roster ID is required.',
            'roster_id.exists'      => 'The selected roster does not exist.',
            'employee_ids.required' => 'At least one employee must be selected.',
            'employee_ids.array'    => 'Employee IDs must be an array.',
            'employee_ids.*.exists'=> 'One or more selected employees do not exist.',
        ];
    }
}
