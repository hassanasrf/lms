<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
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
        $companyId = auth()->user()->company_id;
        $bankId = $this->route('bank');

        return [
            'line_name' => 'required|string|max:255',
            'agent_ids' => [
                'nullable',
                'array',
                Rule::exists('agents', 'id')->where('company_id', $companyId),
            ],
            'owner' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_person_name' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'cell' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'bank_ids' => [
                'nullable', 
                'array',
                Rule::exists('banks', 'id')->where('company_id', $companyId),
            ],
            'payment_type' => 'required|in:Cash,Cheque,Pay Order,Online',
            'credit_period' => 'required|integer|min:1',
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
            'line_name' => 'line name',
            'agent_ids' => 'local agent IDs',
            'owner' => 'owner',
            'address' => 'address',
            'contact_person_name' => 'contact person name',
            'tel' => 'telephone number',
            'cell' => 'cell number',
            'fax' => 'fax number',
            'bank_ids' => 'bank IDs',
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
            'line_name.required' => 'The line name is required.',
            'agent_ids.array' => 'The local agent IDs must be an array.',
            'agent_ids.exists' => 'One or more selected local agents are invalid.',
            'owner.required' => 'The owner is required.',
            'address.required' => 'The address is required.',
            'contact_person_name.required' => 'The contact person name is required.',
            'payment_type.required' => 'The payment type is required.',
            'payment_type.in' => 'The payment type must be one of the following: Cash, Cheque, Pay Order, Online.',
            'credit_period.required' => 'The credit period is required.',
            'credit_period.integer' => 'The credit period must be an integer.',
            'credit_period.min' => 'The credit period must be at least 1 day.',
            'bank_ids.array' => 'The bank IDs must be an array.',
            'bank_ids.exists' => 'One or more selected bank IDs are invalid.',
        ];
    }
}
