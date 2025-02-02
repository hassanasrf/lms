<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
            'agents' => 'nullable|array',
            'agents.*.agent_id' => [
                'required',
                'integer',
                Rule::exists('agents', 'id')->where('company_id', $companyId),
            ],
            'agents.*.payment_type' => 'required|string',
            'agents.*.credit_type' => 'required|string',
            'owner' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'tel' => 'nullable|string|max:20',
            'cell' => 'nullable|string|max:20',
            'fax' => 'nullable|string|max:20',
            'bank_ids' => [
                'nullable', 
                'array',
                Rule::exists('banks', 'id')->where('company_id', $companyId),
            ]
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
            'agents' => 'local agents',
            'agents.*.agent_id' => 'local agent ID',
            'agents.*.payment_type' => 'payment type for the local agent',
            'agents.*.credit_type' => 'credit type for the local agent',
            'owner' => 'owner',
            'contact_person_name' => 'contact person name',
            'tel' => 'telephone number',
            'cell' => 'cell number',
            'fax' => 'fax number',
            'bank_ids' => 'bank IDs'
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
            'agents.array' => 'The local agents must be an array.',
            'agents.*.agent_id.required' => 'The agent ID is required for each local agent.',
            'agents.*.agent_id.integer' => 'The agent ID must be an integer.',
            'agents.*.agent_id.exists' => 'One or more selected local agents are invalid.',
            'agents.*.payment_type.required' => 'The payment type is required for each local agent.',
            'agents.*.credit_type.required' => 'The credit type is required for each local agent.',
            'owner.required' => 'The owner is required.',
            'contact_person_name.required' => 'The contact person name is required.',
            'bank_ids.array' => 'The bank IDs must be an array.',
            'bank_ids.exists' => 'One or more selected bank IDs are invalid.',
        ];
    }
}
