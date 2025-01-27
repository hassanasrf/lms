<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
        $companyId = auth()->user()->company_id;

        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'country_id' => [
                'nullable',
                Rule::exists('countries', 'id')->where('company_id', $companyId),
            ],
            'city_id' => [
                'nullable',
                Rule::exists('cities', 'id')->where('company_id', $companyId),
            ],
            'contact_persons' => 'nullable|array',
            'contact_persons.*' => 'nullable|string|max:255',
            'contact_numbers' => 'nullable|array',
            'contact_numbers.*' => 'nullable|string|max:20',
            'email_ids' => 'nullable|array',
            'email_ids.*' => 'nullable|email|max:255',
            'tagging_point_ids' => [
                'nullable',
                'array',
                Rule::exists('tagging_points', 'id')->where('company_id', $companyId),
            ],
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
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
            'tagging_point_ids.array' => 'The tagging points field must be an array.',
            'tagging_point_ids.*.exists' => 'Each tagging point must exist in the company.',
        ];
    }
}
