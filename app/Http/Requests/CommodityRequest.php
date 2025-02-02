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
            // Foreign keys validation
            'currency_id' => 'nullable|exists:currencies,id',
            'packing_id' => 'nullable|exists:packages,id',

            // Commodity fields
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'hs_code' => 'nullable|string|max:50',
            'dangerous_cargo' => 'nullable|boolean',
            'undg_code' => 'nullable|string|max:50',
            'dg_class' => 'nullable|string|max:50',
            'dg_chapter' => 'nullable|string|max:50',

            // Import fields
            'cargo_value' => 'nullable|string|max:255',

            // Landing Charges
            'landing_charges' => 'nullable|string|max:255',
            'landing_charges_type' => 'nullable|string|max:50',

            // Insurance fields
            'insurance' => 'nullable|string|max:255',
            'insurance_type' => 'nullable|string|max:50',

            // Customs Duties
            'custom_duty' => 'nullable|string|max:255',
            'custom_duty_type' => 'nullable|string|max:50',

            // Sales Tax fields
            'sales_tax' => 'nullable|string|max:255',
            'sales_tax_type' => 'nullable|string|max:50',

            // VAT fields
            'vat' => 'nullable|string|max:255',
            'vat_type' => 'nullable|string|max:50',

            // Additional Custom Duty fields
            'additional_custom_duty' => 'nullable|string|max:255',
            'additional_custom_duty_type' => 'nullable|string|max:50',

            // Regulatory Duty fields
            'regulatory_duty' => 'nullable|string|max:255',
            'regulatory_duty_type' => 'nullable|string|max:50',

            // Additional Income Tax fields
            'additional_income_tax' => 'nullable|string|max:255',
            'additional_income_tax_type' => 'nullable|string|max:50',

            // Excise Duty fields
            'excise_duty' => 'nullable|string|max:255',
            'excise_duty_type' => 'nullable|string|max:50',

            // Stamp Duty fields
            'stamp_duty_value' => 'nullable|numeric|min:0',
            'stamp_duty_type' => 'nullable|string|max:50',

            // Net Total
            'net_total' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'currency_id.exists' => 'The selected currency does not exist.',
            'packing_id.exists' => 'The selected packing type does not exist.',
            
            'name.required' => 'The commodity name is required.',
            'name.string' => 'The commodity name must be a string.',
            'name.max' => 'The commodity name may not be greater than 255 characters.',

            'type.required' => 'The commodity type is required.',
            'type.string' => 'The commodity type must be a string.',
            'type.max' => 'The commodity type may not be greater than 255 characters.',
            
            'hs_code.string' => 'The HS code must be a string.',
            'hs_code.max' => 'The HS code may not be greater than 50 characters.',
            
            'dangerous_cargo.boolean' => 'The dangerous cargo field must be a boolean.',
            
            'undg_code.string' => 'The UNDG code must be a string.',
            'undg_code.max' => 'The UNDG code may not be greater than 50 characters.',
            
            'dg_class.string' => 'The DG class must be a string.',
            'dg_class.max' => 'The DG class may not be greater than 50 characters.',
            
            'dg_chapter.string' => 'The DG chapter must be a string.',
            'dg_chapter.max' => 'The DG chapter may not be greater than 50 characters.',
            
            'cargo_value.string' => 'The cargo value must be a string.',
            'cargo_value.max' => 'The cargo value may not be greater than 255 characters.',
            
            'landing_charges.string' => 'The landing charges must be a string.',
            'landing_charges.max' => 'The landing charges may not be greater than 255 characters.',
            
            'landing_charges_type.string' => 'The landing charges type must be a string.',
            'landing_charges_type.max' => 'The landing charges type may not be greater than 50 characters.',
            
            'insurance.string' => 'The insurance must be a string.',
            'insurance.max' => 'The insurance may not be greater than 255 characters.',
            
            'insurance_type.string' => 'The insurance type must be a string.',
            'insurance_type.max' => 'The insurance type may not be greater than 50 characters.',
            
            'custom_duty.string' => 'The customs duty must be a string.',
            'custom_duty.max' => 'The customs duty may not be greater than 255 characters.',
            
            'custom_duty_type.string' => 'The customs duty type must be a string.',
            'custom_duty_type.max' => 'The customs duty type may not be greater than 50 characters.',
            
            'sales_tax.string' => 'The sales tax must be a string.',
            'sales_tax.max' => 'The sales tax may not be greater than 255 characters.',
            
            'sales_tax_type.string' => 'The sales tax type must be a string.',
            'sales_tax_type.max' => 'The sales tax type may not be greater than 50 characters.',
            
            'vat.string' => 'The VAT must be a string.',
            'vat.max' => 'The VAT may not be greater than 255 characters.',
            
            'vat_type.string' => 'The VAT type must be a string.',
            'vat_type.max' => 'The VAT type may not be greater than 50 characters.',
            
            'additional_custom_duty.string' => 'The additional custom duty must be a string.',
            'additional_custom_duty.max' => 'The additional custom duty may not be greater than 255 characters.',
            
            'additional_custom_duty_type.string' => 'The additional custom duty type must be a string.',
            'additional_custom_duty_type.max' => 'The additional custom duty type may not be greater than 50 characters.',
            
            'regulatory_duty.string' => 'The regulatory duty must be a string.',
            'regulatory_duty.max' => 'The regulatory duty may not be greater than 255 characters.',
            
            'regulatory_duty_type.string' => 'The regulatory duty type must be a string.',
            'regulatory_duty_type.max' => 'The regulatory duty type may not be greater than 50 characters.',
            
            'additional_income_tax.string' => 'The additional income tax must be a string.',
            'additional_income_tax.max' => 'The additional income tax may not be greater than 255 characters.',
            
            'additional_income_tax_type.string' => 'The additional income tax type must be a string.',
            'additional_income_tax_type.max' => 'The additional income tax type may not be greater than 50 characters.',
            
            'excise_duty.string' => 'The excise duty must be a string.',
            'excise_duty.max' => 'The excise duty may not be greater than 255 characters.',
            
            'excise_duty_type.string' => 'The excise duty type must be a string.',
            'excise_duty_type.max' => 'The excise duty type may not be greater than 50 characters.',
            
            'stamp_duty_value.numeric' => 'The stamp duty value must be a numeric value.',
            'stamp_duty_value.min' => 'The stamp duty value must be at least 0.',
            'stamp_duty_type.string' => 'The stamp duty type must be a string.',
            'stamp_duty_type.max' => 'The stamp duty type may not be greater than 50 characters.',
            
            'net_total.string' => 'The net total must be a string.',
            'net_total.max' => 'The net total may not be greater than 255 characters.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'currency_id' => 'currency',
            'packing_id' => 'packing type',
            'sales_tax' => 'sales tax',
            'vat' => 'VAT',
            'net_total' => 'net total',
        ];
    }
}
