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
            'terminal_id' => 'nullable|exists:tagging_points,id',
            'last_call_id' => 'nullable|exists:tagging_points,id',
            'next_call_id' => 'nullable|exists:tagging_points,id',
            'voyage_number' => 'nullable|string|max:255',

            // Routing IDs (Voyage Routing)
            'routing_ids' => 'nullable|array',
            'routing_ids.*' => 'exists:tagging_points,id',

            // Routing
            'transit_time_routing_port_id' => 'nullable|exists:tagging_points,id',
            'transit_time_additional_ports' => 'nullable|integer',

            // Timing and Status
            'shipping_instruction' => 'nullable|date',
            'cut_off_time' => 'nullable|date',
            'expected_time_of_arrival' => 'nullable|date',
            'arrived_at' => 'nullable|date',
            'expected_time_of_departure' => 'nullable|date',
            'sailed_at' => 'nullable|date',

            // Customs and Documentation
            'vir_number' => 'nullable|string|max:255',
            'vir_date' => 'nullable|date',
            'custom_file_number' => 'nullable|string|max:255',
            'bond_submitted_date' => 'nullable|date',

            // Slot Partners
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
