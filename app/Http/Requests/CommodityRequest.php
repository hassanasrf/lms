<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class CommodityRequest extends BaseRequest
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
            'company_id' => 'required|exists:companies,id',
            'name' => 'required|string|max:255',
            'hs_code' => 'nullable|string|max:255',
            'dangerous_cargo' => 'required|boolean',
            'undg_code' => 'nullable|string|max:255',
            'dg_class' => 'nullable|string|max:255',
            'dg_chapter' => 'nullable|string|max:255',
            'cargo_value' => 'nullable|numeric|min:0',
            'currency_id' => 'nullable|exists:currencies,id',
            'packing_id' => 'nullable|exists:packages,id',
            'landing_charges_percentage' => 'nullable|numeric|min:0|max:100',
            'landing_charges_type' => 'nullable|in:Percentage,Multiply,Value',
            'insurance_percentage' => 'nullable|numeric|min:0|max:100',
            'insurance_type' => 'nullable|in:Percentage,Multiply,Value',
            'custom_duty_percentage' => 'nullable|numeric|min:0|max:100',
            'custom_duty_type' => 'nullable|in:Percentage,Multiply,Value',
            'sales_tax_percentage' => 'nullable|numeric|min:0|max:100',
            'sales_tax_type' => 'nullable|in:Percentage,Multiply,Value',
            'vat_percentage' => 'nullable|numeric|min:0|max:100',
            'vat_type' => 'nullable|in:Percentage,Multiply,Value',
            'additional_custom_duty_percentage' => 'nullable|numeric|min:0|max:100',
            'additional_custom_duty_type' => 'nullable|in:Percentage,Multiply,Value',
            'regulatory_duty_percentage' => 'nullable|numeric|min:0|max:100',
            'regulatory_duty_type' => 'nullable|in:Percentage,Multiply,Value',
            'additional_income_tax_percentage' => 'nullable|numeric|min:0|max:100',
            'additional_income_tax_type' => 'nullable|in:Percentage,Multiply,Value',
            'excise_duty_percentage' => 'nullable|numeric|min:0|max:100',
            'excise_duty_type' => 'nullable|in:Percentage,Multiply,Value',
            'stamp_duty_value' => 'nullable|numeric|min:0',
            'stamp_duty_type' => 'nullable|in:Percentage,Multiply,Value',
            'export_value_per_kg' => 'nullable|numeric|min:0',
            'export_currency' => 'nullable|in:USD,PKR,AED,ETC'
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
