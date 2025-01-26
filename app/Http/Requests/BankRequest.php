<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class BankRequest extends BaseRequest
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
        $bankId = $this->route('bank');

        return [
            'type_ids' => [
                'nullable', 
                'array',
                Rule::exists('customer_types', 'id'),
            ],
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'country_id' => [
                'nullable',
                Rule::exists('countries', 'id')->where('company_id', $companyId),
            ],
            'city_id' => [
                'nullable',
                Rule::exists('cities', 'id')->where('company_id', $companyId),
            ],
            'title' => 'required|string|max:255',
            'account_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('banks', 'account_number')->ignore($bankId),
            ],
            'iban_number' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('banks', 'iban_number')->ignore($bankId),
            ],
            'swift_code' => 'nullable|string|max:20',
            'account_type' => 'required|string|max:50',
            'currency_id' => [
                'required',
                Rule::exists('customer_types', 'id'),
            ],
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'type.array' => 'The type must be an array of selected values.',
            'type.exists' => 'One or more selected types are invalid or do not exist.',
            
            'bank_name.required' => 'The bank name is required.',
            'bank_name.string' => 'The bank name must be a string.',
            'bank_name.max' => 'The bank name cannot exceed 255 characters.',
            
            'branch_name.required' => 'The branch name is required.',
            'branch_name.string' => 'The branch name must be a string.',
            'branch_name.max' => 'The branch name cannot exceed 255 characters.',
            
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address cannot exceed 500 characters.',
            
            'country_id.exists' => 'The selected country is invalid or does not belong to your company.',
            'city_id.exists' => 'The selected city is invalid or does not belong to your company.',
            
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title cannot exceed 255 characters.',
            
            'account_number.required' => 'The account number is required.',
            'account_number.string' => 'The account number must be a string.',
            'account_number.max' => 'The account number cannot exceed 50 characters.',
            'account_number.unique' => 'This account number already exists.',
            
            'iban_number.string' => 'The IBAN number must be a string.',
            'iban_number.max' => 'The IBAN number cannot exceed 50 characters.',
            'iban_number.unique' => 'This IBAN number already exists.',
            
            'swift_code.string' => 'The SWIFT code must be a string.',
            'swift_code.max' => 'The SWIFT code cannot exceed 20 characters.',
            
            'account_type.required' => 'The account type is required.',
            'account_type.string' => 'The account type must be a string.',
            'account_type.max' => 'The account type cannot exceed 50 characters.',
            
            'currency_id.required' => 'The currency ID is required.',
            'currency_id.exists' => 'The selected currency type is invalid.',
        ];
    }
}
