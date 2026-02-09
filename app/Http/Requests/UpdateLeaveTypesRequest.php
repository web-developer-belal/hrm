<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeaveTypesRequest extends FormRequest
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
            'name' => 'required|unique:leave_types,name,'. $this->leave_type->id,
            'annual_limit'=>'required|integer',
        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'Department name is required!',
            'annual_limit.required' => 'Annual limit is required!',
            'annual_limit.integer' => 'Annual limit must be an integer!',

        ];
    }
}
