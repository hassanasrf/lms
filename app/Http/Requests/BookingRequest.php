<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

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
        $companyId = auth()->user()->company_id;

        return [
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')->where('company_id', $companyId),
            ],
            'booking_type' => 'nullable|string|max:255',
            'service_type_ids' => [
                'nullable', 
                'array',
                Rule::exists('service_types', 'id'),
            ],
            'shipment_type' => 'nullable|string|max:255',
            'number_of_containers' => 'nullable|integer|min:1',
            'bulk_details' => 'nullable|string|max:255',
            'other_details' => 'nullable|string|max:255',
            'loading_point_id' => [
                'nullable',
                Rule::exists('tagging_points', 'id')->where('company_id', $companyId),
            ],
            'commodity_id' => [
                'nullable',
                Rule::exists('commodities', 'id')->where('company_id', $companyId),
            ],
            'destination_country_id' => [
                'nullable',
                Rule::exists('tagging_points', 'id')->where('company_id', $companyId),
            ],
            'licence_name' => 'nullable|string|max:255',
            'mailing_details' => 'nullable|string|max:1000',
            'shipping_line_id' => [
                'required',
                Rule::exists('shipping_lines', 'id')->where('company_id', $companyId),
            ],
            'voyage_id' => [
                'nullable',
                Rule::exists('voyages', 'id')->where('company_id', $companyId),
            ],
            'fumigation_required' => 'required|boolean',
            'fumigation_certificate_required' => 'required|boolean',
            'document_type' => 'nullable|string|max:255',
            'loading_person' => 'nullable|string|max:255',
            'loading_person_cell' => 'nullable|string|max:20',
        ];
    }

    /**
     * Get the custom attributes for validation error messages.
     */
    public function attributes(): array
    {
        return [
            'customer_id' => 'customer',
            'booking_type' => 'booking type',
            'shipment_type' => 'shipment type',
            'number_of_containers' => 'number of containers',
            'bulk_details' => 'bulk details',
            'other_details' => 'other details',
            'loading_point_id' => 'loading point',
            'commodity_id' => 'commodity',
            'destination_country_id' => 'destination country',
            'licence_name' => 'licence name',
            'mailing_details' => 'mailing details',
            'shipping_line_id' => 'shipping line',
            'voyage_id' => 'voyage',
            'fumigation_required' => 'fumigation required',
            'fumigation_certificate_required' => 'fumigation certificate required',
            'document_type' => 'document type',
            'loading_person' => 'loading person',
            'loading_person_cell' => 'loading person cell',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'customer_id.required' => 'The customer is required.',
            'customer_id.exists' => 'The selected customer does not exist for this company.',
            'booking_type.string' => 'The booking type must be a string.',
            'shipment_type.string' => 'The shipment type must be a string.',
            'number_of_containers.integer' => 'The number of containers must be an integer.',
            'loading_point_id.exists' => 'The selected loading point does not exist for this company.',
            'commodity_id.exists' => 'The selected commodity does not exist for this company.',
            'destination_country_id.exists' => 'The selected destination country does not exist for this company.',
            'fumigation_required.boolean' => 'The fumigation required field must be true or false.',
            'fumigation_certificate_required.boolean' => 'The fumigation certificate required field must be true or false.',
            'shipping_line_id.exists' => 'The selected shipping line does not exist for this company.',
            'shipping_line_id.required' => 'The shipping line is required.',
            'voyage_id.exists' => 'The selected voyage does not exist for this company.',
            'document_type.string' => 'The document type must be a string.',
            'loading_person.string' => 'The loading person must be a string.',
            'loading_person_cell.string' => 'The loading person cell must be a string.',
        ];
    }
}
