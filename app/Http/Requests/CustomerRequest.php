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
        return [
            'company_id' => 'required|exists:companies,id',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'ntn' => 'nullable|string|max:50',
            'str' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_no' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
        ];
    }

    protected function update()
    {
        $model = request()->route('company');
        return [
            'company_id' => 'required|exists:companies,id',
            'country_id' => 'nullable|exists:countries,id',
            'city_id' => 'nullable|exists:cities,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'ntn' => 'nullable|string|max:50',
            'str' => 'nullable|string|max:50',
            'licence_name' => 'nullable|string|max:255',
            'licence_no' => 'nullable|string|max:100',
            'custom_code' => 'nullable|string|max:50',
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
