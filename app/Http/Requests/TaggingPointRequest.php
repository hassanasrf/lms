<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class TaggingPointRequest extends BaseRequest
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
            'country_id' => [
                'nullable',
                Rule::exists('countries', 'id')->where('company_id', $companyId),
            ],
            'city_id' => [
                'nullable',
                Rule::exists('cities', 'id')->where('company_id', $companyId),
            ],
            'port_name' => 'required|string|max:255',
            'type' => 'required|string|in:city,terminal,yard,loading_point,warehouse',
            'value' => 'required|string|max:255',
            'sales_tax' => 'required|numeric|min:0|max:100',
            'wht' => 'required|numeric|min:0|max:100',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            //
        ];
    }
}
