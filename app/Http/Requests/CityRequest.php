<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class CityRequest extends BaseRequest
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
            'name' => ['required', 'string', 'max:255'/*, 'unique:cities,name'*/],
            'country_id' => ['required', 'exists:countries,id'],
            'code' => ['required', 'string', 'max:10'/*, 'unique:cities,code'*/],
        ];
    }

    /**
     * Get the custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The city name is required.',
            'name.unique' => 'This city name is already taken.',
            'country_id.required' => 'The country ID is required.',
            'country_id.exists' => 'The selected country ID does not exist.',
            'code.required' => 'The city code is required.',
            'code.unique' => 'This city code is already in use.',
        ];
    }
}
