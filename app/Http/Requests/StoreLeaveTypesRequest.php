<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeaveTypesRequest extends FormRequest
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
            'branch_id' => 'required',
            'name' => 'required|unique:leave_types,name',
            'annual_limit'=>'required|integer',
            'is_paid'=>'required|integer',
        ];
    }

     public function messages()
    {
        return [
            'branch_id.required' => 'Branch name is required!',
            'name.required' => 'Leave Type name is required!',
            'annual_limit.required' => 'Annual limit is required!',
            'annual_limit.integer' => 'Annual limit must be an integer!',

        ];
    }
}
