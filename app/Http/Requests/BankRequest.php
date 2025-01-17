<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

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

        return [
            'type' => 'nullable|string|max:255',
            /*'customer_id' => [
                'nullable',
                'exists:customers,id,company_id,' . $companyId,
            ],*/
            'bank_name' => 'required|string|max:255',
            'branch_name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => [
                'nullable',
                'exists:cities,id,company_id,' . $companyId,
            ],
            'country_id' => [
                'nullable',
                'exists:countries,id,company_id,' . $companyId,
            ],
            'title' => 'required|string|max:255',
            'account_number' => 'required|string|max:50|unique:banks,account_number',
            'iban_number' => 'nullable|string|max:50|unique:banks,iban_number',
            'swift_code' => 'nullable|string|max:20',
            'account_type' => 'required|string|max:50',
            'currency' => 'required|string|max:10',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            /*'customer_id.required' => 'The customer ID is required.',
            'customer_id.exists' => 'The selected customer does not exist.',*/
            'city_id.required' => 'The city ID is required.',
            'city_id.exists' => 'The selected city does not exist.',
            'country_id.required' => 'The country ID is required.',
            'country_id.exists' => 'The selected country does not exist.',
            'bank_name.required' => 'The bank name is required.',
            'branch_name.required' => 'The branch name is required.',
            'title.required' => 'The title is required.',
            'account_number.required' => 'The account number is required.',
            'account_number.unique' => 'This account number already exists.',
            'iban_number.unique' => 'This IBAN number already exists.',
            'account_type.required' => 'The account type is required.',
            'currency.required' => 'The currency is required.',
        ];
    }
}
