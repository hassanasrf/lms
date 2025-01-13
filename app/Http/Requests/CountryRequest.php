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
        $companyId = auth()->user()->company_id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                "unique:countries,name,NULL,id,company_id,{$companyId}", // Unique within the same company
            ],
            'code' => [
                'required',
                'string',
                'size:2',
                "unique:countries,code,NULL,id,company_id,{$companyId}", // Unique within the same company
            ],
        ];
    }

    /**
     * Customize the error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The country name is required.',
            'name.unique' => 'This country name is already taken within your company.',
            'code.required' => 'The country code is required.',
            'code.size' => 'The country code must be exactly 2 characters.',
            'code.unique' => 'This country code is already in use within your company.',
        ];
    }
}
