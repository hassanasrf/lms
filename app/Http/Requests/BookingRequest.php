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
            'customer_id' => 'required|exists:customers,id',
            'service_type_ids' => 'required|array',
            'service_type_ids.*' => 'exists:service_types,id',
            'shipment_type' => 'nullable|string|max:255',
            'number_of_containers' => 'nullable|integer',
            'bulk_details' => 'nullable|string|max:255',
            'other_details' => 'nullable|string|max:255',
            'loading_point_id' => 'nullable|exists:tagging_points,id',
            'commodity_id' => 'nullable|exists:commodities,id',
            'destination_country_id' => 'nullable|exists:tagging_points,id',
            'licence_name' => 'nullable|string|max:255',
            'mailing_details' => 'nullable|string|max:255',
            'shipping_line_id' => 'required|exists:shipping_lines,id',
            'vessel_id' => 'required|exists:vessels,id',
            'eta' => 'nullable|date_format:Y-m-d',
            'sgs_required' => 'boolean',
            'fumigation_required' => 'boolean',
            'fumigation_certificate_required' => 'boolean',
            'document_type' => 'nullable|string|max:255',
            'loading_person' => 'nullable|string|max:255',
            'loading_person_cell' => 'nullable|string|max:20',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer ID is required.',
            'service_type_ids.required' => 'Service type IDs are required.',
            'service_type_ids.*.exists' => 'Each service type must exist in the database.',
            'shipment_type.string' => 'Shipment type must be a string.',
            'number_of_containers.integer' => 'Number of containers must be an integer.',
            'loading_point_id.exists' => 'The loading point must exist.',
            'commodity_id.exists' => 'The commodity must exist.',
            'destination_country_id.exists' => 'The destination country must exist.',
            'shipping_line_id.exists' => 'The shipping line must exist.',
            'vessel_id.exists' => 'The vessel must exist.',
            'eta.date_format' => 'ETA must be a valid date in the format YYYY-MM-DD.',
            'sgs_required.boolean' => 'SGS required must be a boolean value.',
            'fumigation_required.boolean' => 'Fumigation required must be a boolean value.',
            'fumigation_certificate_required.boolean' => 'Fumigation certificate required must be a boolean value.',
            'document_type.string' => 'Document type must be a string.',
            'loading_person.string' => 'Loading person must be a string.',
            'loading_person_cell.string' => 'Loading person cell must be a string.',
        ];
    }
}
