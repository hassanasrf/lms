<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class VesselVoyRequest extends BaseRequest
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
           'vessel_name' => 'required|string|max:255',
            'shipping_line_id' => 'nullable|exists:shipping_lines,id',
            'agent_id' => 'nullable|exists:agents,id',
            'type_of_vessel' => [
                'nullable',
                'string',
                'max:255',
                'in:Container,Bulk,"Container & Bulk",RORO,"Break Bulk"'
            ],
            'flag' => 'nullable|string|max:255',
            'gross_tonnage' => 'nullable|numeric',
            'net_tonnage' => 'nullable|numeric',
            'loa' => 'nullable|string|max:255',
            'hatch_cover_lids' => 'nullable|string|max:255',
            'imo_number' => 'nullable|string|max:255',
            'call_sign' => 'nullable|string|max:255',
            'build' => 'nullable|integer|min:1900|max:2099',

            // Terminal Info
            'terminal_name' => 'nullable|string|max:255',
            'country_id' => 'nullable|exists:countries,id',
            'last_voyage_copy' => 'nullable|string|max:255',
            'voyage_number' => 'nullable|string|max:255',
            'last_call' => 'nullable|date',
            'last_call_voyage_copy' => 'nullable|string|max:255',
            'next_call' => 'nullable|date',
            'next_call_voyage_copy' => 'nullable|string|max:255',

            // Routing
            'routing' => 'nullable|array',
            'routing.*.port' => 'required|string|max:255',
            'routing.*.country_id' => 'required|exists:countries,id',
            'transit_time_routing_ports' => 'nullable|integer',
            'additional_ports' => 'nullable|array',
            'additional_ports.*.port' => 'required|string|max:255',
            'additional_ports.*.country_id' => 'required|exists:countries,id',
            'transit_time_additional_ports' => 'nullable|integer',
            'via_ports' => 'nullable|array',
            'via_ports.*.via_port' => 'required|string|max:255',
            'via_ports.*.country_id' => 'required|exists:countries,id',

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
            'slot_partners.*.partner_name' => 'required|string|max:255',
            'slot_partners.*.id' => 'required|integer',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'routing.*.port.required' => 'Each routing port must have a valid port name.',
            'routing.*.country_id.required' => 'Each routing port must have a valid country.',
            'additional_ports.*.port.required' => 'Each additional port must have a valid port name.',
            'additional_ports.*.country_id.required' => 'Each additional port must have a valid country.',
            'via_ports.*.via_port.required' => 'Each via port must have a valid port name.',
            'via_ports.*.country_id.required' => 'Each via port must have a valid country.',
        ];
    }
}
