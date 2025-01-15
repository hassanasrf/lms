<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class CustomerRequest extends BaseRequest
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
        $companyId = auth()->user()->company_id;

        return [
            'country_id' => [
                'nullable',
                'exists:countries,id,company_id,' . $companyId,
            ],
            'city_id' => [
                'nullable',
                'exists:cities,id,company_id,' . $companyId,
            ],
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'ntn' => 'nullable|string|max:50',
            'str' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_no' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'customer_type_id' => 'required|exists:customer_types,id',
        ];
    }

    protected function update()
    {
        $companyId = auth()->user()->company_id;
        $model = request()->route('company');

        return [
            'country_id' => [
                'nullable',
                'exists:countries,id,company_id,' . $companyId,
            ],
            'city_id' => [
                'nullable',
                'exists:cities,id,company_id,' . $companyId,
            ],
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'ntn' => 'nullable|string|max:50',
            'str' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_no' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
            'customer_type_id' => 'required|exists:customer_types,id',
            '_method' => 'required|in:put',
        ];
    }

    /**
     * Customize the validation error messages.
     */
    public function messages(): array
    {
        return [];
    }
}
