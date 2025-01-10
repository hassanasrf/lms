<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class CountryRequest extends BaseRequest
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
            'company_id' => ['sometime', 'nullable', 'exists:companies,id'],
            'name' => ['required', 'string', 'max:255', 'unique:countries,name'],
            'code' => ['required', 'string', 'size:2', 'unique:countries,code'],
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'company_id.exists' => 'The selected company ID does not exist.',
            'name.required' => 'The country name is required.',
            'name.unique' => 'This country name is already taken.',
            'code.required' => 'The country code is required.',
            'code.size' => 'The country code must be exactly 2 characters.',
            'code.unique' => 'This country code is already in use.',
        ];
    }
}
