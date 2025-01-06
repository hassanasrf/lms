<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'is_active' => 'sometimes|boolean',
            'role' => 'required|exists:roles,name',
        ];
    }

    protected function update()
    {
        $model = request()->route('user');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $model->id,
            'password' => 'sometimes|min:6',
            'is_active' => 'sometimes|boolean',
            'role' => 'required|exists:roles,name',
            '_method' => 'required|in:put',
        ];
    }
}
