<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

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
                'exists:countries,id,company_id,' . $companyId,
            ],
            'city_id' => [
                'nullable',
                'exists:cities,id,company_id,' . $companyId,
            ],
            'type' => 'required|string|in:City,Terminal,Yard',
            'port_name' => 'required|string|max:255',
            'terminal_name' => 'required|string|max:255',
            'yard_name' => 'required|string|max:255',
            'bonded_area' => 'required|boolean',
            'loading_point' => 'required|string|max:20',
            'warehouse' => 'required|string|max:20',
            'sales_tax_percentage' => 'required|numeric|min:0|max:100',
            'wht_percentage' => 'required|numeric|min:0|max:100',
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
