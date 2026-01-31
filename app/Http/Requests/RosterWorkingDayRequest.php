<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RosterWorkingDayRequest extends FormRequest
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
            'type'           => 'required|in:off,working,holiday',
            'day'            => 'required|in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
        ];
    }

    public function messages(): array
    {
        return [
            'roster_id.required' => 'Roster ID is required.',
            'roster_id.exists'   => 'The selected roster does not exist.',
            'type.required'      => 'Type is required.',
            'type.in'            => 'Type must be one of the following: off, working, holiday.',
            'day.required'       => 'Day is required.',
            'day.in'             => 'Day must be a valid day of the week.',
        ];
    }
}
