<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class CompanyRequest extends BaseRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return []
        +
        ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store()
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'ntn_number' => 'nullable|string|max:50',
            'str_number' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_number' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'type_id' => 'required|exists:types,id',
            'logo' => 'sometimes|nullable',
        ];
    }

    protected function update()
    {
        $model = request()->route('company');
        return [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'nullable|exists:countries,id',
            'ntn_number' => 'nullable|string|max:50',
            'str_number' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_number' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'telephone' => 'nullable|string|max:20',
            'type_id' => 'required|exists:types,id',
            'logo' => 'sometimes|nullable',
            '_method' => 'required|in:put',
        ];
    }

    /**
     * Customize the validation error messages.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The company name is required.',
            'city_id.required' => 'The city is required.',
            'city_id.exists' => 'The selected city is invalid.',
            'type_id.required' => 'The company type is required.',
            'type_id.exists' => 'The selected type is invalid.',
        ];
    }
}
