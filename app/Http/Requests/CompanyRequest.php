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
            '_method' => 'required|in:put',

            'domains' => 'nullable|array',
            'domains.*.name' => [
                'required',
                'string',
                Rule::unique('domains', 'name')->ignore($model->id),
                'regex:/^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', // Valid domain format
            ],
            'subdomains' => 'nullable|array',
            'subdomains.*.name' => [
                'required',
                'string',
                Rule::unique('subdomains', 'name')->ignore($model->id),
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
            'city_id.required' => 'The city is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'type_id.required' => 'The company type is required.',
            'type_id.exists' => 'The selected type is invalid.',
        ];
    }
}
