<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class AgentRequest extends BaseRequest
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
     */
    public function rules(): array
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => 'nullable|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'contact_persons' => 'nullable|array',
            'contact_persons.*' => 'nullable|string|max:255',
            'contact_numbers' => 'nullable|array',
            'contact_numbers.*' => 'nullable|string|max:20',
            'email_ids' => 'nullable|array',
            'email_ids.*' => 'nullable|email|max:255',
            'ports' => 'nullable|array',
            'ports.*' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'company_id.required' => 'The company ID is required.',
            'company_id.exists' => 'The selected company ID does not exist.',
            'name.required' => 'The agent name is required.',
            'name.string' => 'The agent name must be a string.',
            'name.max' => 'The agent name may not be greater than 255 characters.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 500 characters.',
            'city_id.exists' => 'The selected city does not exist.',
            'country_id.exists' => 'The selected country does not exist.',
            'contact_persons.array' => 'The contact persons field must be an array.',
            'contact_persons.*.string' => 'Each contact person must be a string.',
            'contact_persons.*.max' => 'Each contact person may not be greater than 255 characters.',
            'contact_numbers.array' => 'The contact numbers field must be an array.',
            'contact_numbers.*.string' => 'Each contact number must be a string.',
            'contact_numbers.*.max' => 'Each contact number may not be greater than 20 characters.',
            'email_ids.array' => 'The email IDs field must be an array.',
            'email_ids.*.email' => 'Each email ID must be a valid email address.',
            'email_ids.*.max' => 'Each email ID may not be greater than 255 characters.',
            'ports.array' => 'The ports field must be an array.',
            'ports.*.string' => 'Each port must be a string.',
            'ports.*.max' => 'Each port may not be greater than 255 characters.',
        ];
    }
}
