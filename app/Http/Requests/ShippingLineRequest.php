<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class ShippingLineRequest extends BaseRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'line_name' => 'required|string|max:255',
            'local_agent' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person_name' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'cell' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'bank_details' => 'nullable|json', // Ensuring bank details is a valid JSON
            'payment_type' => 'required|in:Cash,Cheque,Pay Order,Online',
            'credit_period' => 'required|integer|min:1', // Ensure credit period is a positive integer
        ];
    }

    /**
     * Get the custom attributes for the validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'company_id' => 'company',
            'line_name' => 'line name',
            'local_agent' => 'local agent',
            'owner' => 'owner',
            'address' => 'address',
            'contact_person_name' => 'contact person name',
            'tel' => 'telephone number',
            'cell' => 'cell number',
            'fax' => 'fax number',
            'bank_details' => 'bank details',
            'payment_type' => 'payment type',
            'credit_period' => 'credit period',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'company_id.required' => 'The company is required.',
            'company_id.exists' => 'The selected company is invalid.',
            'line_name.required' => 'The line name is required.',
            'local_agent.required' => 'The local agent is required.',
            'owner.required' => 'The owner is required.',
            'address.required' => 'The address is required.',
            'contact_person_name.required' => 'The contact person name is required.',
            'payment_type.required' => 'The payment type is required.',
            'payment_type.in' => 'The payment type must be one of the following: Cash, Cheque, Pay Order, Online.',
            'credit_period.required' => 'The credit period is required.',
            'credit_period.integer' => 'The credit period must be an integer.',
            'credit_period.min' => 'The credit period must be at least 1 day.',
        ];
    }
}
