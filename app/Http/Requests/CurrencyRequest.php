<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CurrencyRequest extends BaseRequest
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
        $currencyId = $this->route('currency'); // Get the currency ID from the route (if updating)

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('currencies', 'name')->ignore($currencyId),
            ],
            'code' => [
                'required',
                'string',
                'size:3',
                Rule::unique('currencies', 'code')->ignore($currencyId),
            ],
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The currency name is required.',
            'name.unique' => 'This currency name is already in use.',
            'code.required' => 'The currency code is required.',
            'code.size' => 'The currency code must be exactly 3 characters.',
            'code.unique' => 'This currency code is already in use.',
        ];
    }
}
