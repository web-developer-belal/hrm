<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RosterRequest extends FormRequest
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
            'name'            => 'required|string|max:255',
            'branch_id'      => 'required|exists:branches,id',
            'department_id'  => 'required|exists:departments,id',
            'shift_id'       => 'required|exists:shifts,id',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status'         => 'required|in:active,inactive',
            'working_days.*'         => 'required',
            'weekly_off_days.*'         => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'Roster name is required.',
            'branch_id.required'      => 'Branch selection is required.',
            'branch_id.exists'        => 'Selected branch does not exist.',
            'department_id.required'  => 'Department selection is required.',
            'department_id.exists'    => 'Selected department does not exist.',
            'shift_id.required'       => 'Shift selection is required.',
            'shift_id.exists'         => 'Selected shift does not exist.',
            'start_date.required'     => 'Start date is required.',
            'start_date.date'         => 'Start date must be a valid date.',
            'end_date.required'       => 'End date is required.',
            'end_date.date'           => 'End date must be a valid date.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            'status.required'         => 'Status is required.',
            'working_days.required'   => 'Working Days is requird .',
            'weekly_off_days.required'   => 'Working Days off is requird .',
            'status.in'               => 'Status must be either active or inactive.',
        ];
    }
}
