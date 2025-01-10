<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class BookingRequest extends BaseRequest
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
            'customer_id' => 'required|exists:customers,id',
            'service_type' => 'nullable|string',
            'shipment_type' => 'nullable|in:By Sea,By Air,By Road',
            'number_of_containers' => 'nullable|integer|min:0',
            'bulk_details' => 'nullable|string|max:255',
            'other_details' => 'nullable|string|max:255',
            'loading_point_id' => 'nullable|exists:tagging_points,id',
            'commodity_id' => 'nullable|exists:commodities,id',
            'destination_country_id' => 'nullable|exists:tagging_points,id',
            'licence_name' => 'nullable|string|max:255',
            'mailing_details' => 'nullable|string',
            'shipping_line_id' => 'required|exists:shipping_lines,id',
            'vessel_name_voy' => 'nullable|string|max:255',
            'eta' => 'nullable|date',
            'sgs_required' => 'boolean',
            'fumigation_required' => 'boolean',
            'fumigation_certificate_required' => 'boolean',
            'document_type' => 'nullable|in:CNF,CIF,FOB,ETC',
            'loading_person' => 'nullable|string|max:255',
            'loading_person_cell' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'company_id.required' => 'The company ID is required.',
            'company_id.exists' => 'The selected company ID does not exist.',
            'customer_id.required' => 'The customer ID is required.',
            'customer_id.exists' => 'The selected customer ID does not exist.',
            'shipping_line_id.required' => 'The shipping line ID is required.',
            'shipping_line_id.exists' => 'The selected shipping line ID does not exist.',
        ];
    }
}
