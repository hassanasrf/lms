<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class VesselRequest extends BaseRequest
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
            'type_of_vessel' => 'nullable|string|max:255',
            'flag' => 'nullable|string|max:255',
            'gross_tonnage' => 'nullable|numeric|min:0',
            'net_tonnage' => 'nullable|numeric|min:0',
            'loa' => 'nullable|string|max:255',
            'hatch_cover_lids' => 'nullable|string|max:255',
            'imo_number' => 'nullable|string|max:255',
            'call_sign' => 'nullable|string|max:255',
            'build' => 'nullable|integer|digits:4|min:1800|max:' . now()->year,
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
