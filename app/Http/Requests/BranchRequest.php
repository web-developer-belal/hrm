<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchRequest extends FormRequest
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
           'name' => 'required|string|max:255',
           'address' => 'required|string|max:500',
           'contact' => 'nullable|string|max:20',
           'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The branch name is required.',
            'name.string' => 'The branch name must be a string.',
            'name.max' => 'The branch name may not be greater than 255 characters.',
            'address.required' => 'The address is required.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 500 characters.',
            'contact.string' => 'The contact must be a string.',
            'contact.max' => 'The contact may not be greater than 20 characters.',
            'status.required' => 'The status is required.',
            'status.enum' => 'The status must be either active or inactive.',
        ];
    }
}
