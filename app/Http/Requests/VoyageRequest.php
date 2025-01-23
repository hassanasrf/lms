<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class VoyageRequest extends BaseRequest
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
            'vessel_id' => 'required|exists:vessels,id',
            'terminal_name' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'last_voyage_copy' => 'nullable|string|max:255',
            'voyage_number' => 'nullable|string|max:255',
            'last_call' => 'nullable|date',
            'last_call_voyage_copy' => 'nullable|string|max:255',
            'next_call' => 'nullable|date',
            'next_call_voyage_copy' => 'nullable|string|max:255',
            'routing' => 'nullable|array',
            'transit_time_routing_ports' => 'nullable|integer|min:0',
            'additional_ports' => 'nullable|array',
            'transit_time_additional_ports' => 'nullable|integer|min:0',
            'via_ports' => 'nullable|array',
            'shipping_instruction' => 'nullable|date',
            'cut_off_time' => 'nullable|date',
            'expected_time_of_arrival' => 'nullable|date',
            'arrived_at' => 'nullable|date',
            'expected_time_of_departure' => 'nullable|date',
            'sailed_at' => 'nullable|date',
            'vir_number' => 'nullable|string|max:255',
            'vir_date' => 'nullable|date',
            'custom_file_number' => 'nullable|string|max:255',
            'bond_submitted_date' => 'nullable|date',
            'slot_partners' => 'nullable|array',
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
