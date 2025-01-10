<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Routing\Route;

class UserRequest extends BaseRequest
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
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:companies,id',
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
            'role_id' => 'required|exists:roles,id',
            'company_id' => 'required|exists:companies,id',
            '_method' => 'required|in:put',
        ];
    }
}
