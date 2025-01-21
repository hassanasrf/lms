<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;
use Illuminate\Validation\Rule;

class CompanyRequest extends BaseRequest
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
        return []
        +
        ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'ntn_number' => 'nullable|string|max:50',
            'str_number' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_number' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'company_type_ids' => 'required|array',
            'company_type_ids.*' => 'exists:company_types,id',
            'logo' => 'sometimes|nullable',
            'primary_color' => 'sometimes|nullable',

            'domains' => 'nullable|array',
            'domains.*.name' => [
                'required',
                'string',
                'unique:domains,name',
                'regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/',
            ],
            'subdomains' => 'nullable|array',
            'subdomains.*.name' => [
                'required',
                'string',
                'unique:subdomains,name',
                'regex:/^[a-zA-Z0-9.-]+$/',
            ],
        ];
    }

    protected function update()
    {
        $model = request()->route('company');
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'ntn_number' => 'nullable|string|max:50',
            'str_number' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_number' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'company_type_ids' => 'required|array',
            'company_type_ids.*' => 'exists:company_types,id',
            'logo' => 'sometimes|nullable',
            'primary_color' => 'sometimes|nullable',
            '_method' => 'required|in:put',

            'domains' => 'nullable|array',
            'domains.*.name' => [
                'required',
                'string',
                Rule::unique('domains', 'name')->ignore($model->id, 'company_id'),
                'regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', // Valid domain format
            ],
            'subdomains' => 'nullable|array',
            'subdomains.*.name' => [
                'required',
                'string',
                Rule::unique('subdomains', 'name')->ignore($model->id, 'company_id'),
                'regex:/^[a-zA-Z0-9.-]+$/',
            ],
        ];
    }

    /**
     * Customize the validation error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'name.string' => 'The company name must be a valid string.',
            'name.max' => 'The company name should not exceed 255 characters.',
            'address.string' => 'The address must be a valid string.',
            'address.max' => 'The address should not exceed 500 characters.',
            'city_id.required' => 'The city is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'country_id.exists' => 'The selected country is invalid.',
            'ntn_number.string' => 'The NTN number must be a valid string.',
            'ntn_number.max' => 'The NTN number should not exceed 50 characters.',
            'str_number.string' => 'The STR number must be a valid string.',
            'str_number.max' => 'The STR number should not exceed 50 characters.',
            'licence_name.string' => 'The licence name must be a valid string.',
            'licence_name.max' => 'The licence name should not exceed 255 characters.',
            'licence_number.string' => 'The licence number must be a valid string.',
            'licence_number.max' => 'The licence number should not exceed 100 characters.',
            'custom_code.string' => 'The custom code must be a valid string.',
            'custom_code.max' => 'The custom code should not exceed 50 characters.',
            'telephone.string' => 'The telephone number must be a valid string.',
            'telephone.max' => 'The telephone number should not exceed 20 characters.',
            'company_type_ids.required' => 'The company type is required.',
            'company_type_ids.array' => 'The company type must be an array.',
            'company_type_ids.*.exists' => 'The selected company type is invalid.',
            'logo.sometimes' => 'The logo is optional but must be a valid file if provided.',
            'primary_color.sometimes' => 'The primary color is optional but must be a valid color code if provided.',
            'domains.array' => 'The domains must be an array.',
            'domains.*.name.required' => 'The domain name is required.',
            'domains.*.name.string' => 'The domain name must be a valid string.',
            'domains.*.name.unique' => 'The domain name must be unique.',
            'domains.*.name.regex' => 'The domain name format is invalid.',
            'subdomains.array' => 'The subdomains must be an array.',
            'subdomains.*.name.required' => 'The subdomain name is required.',
            'subdomains.*.name.string' => 'The subdomain name must be a valid string.',
            'subdomains.*.name.unique' => 'The subdomain name must be unique.',
            'subdomains.*.name.regex' => 'The subdomain name format is invalid.',
        ];
    }
}
