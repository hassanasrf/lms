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
        return array_merge(
            ($this->isMethod('POST') ? $this->store() : $this->update()),
            $this->guardSpecificRules()
        );
    }

    /**
     * Validation rules for creating a new user.
     */
    protected function store(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'is_active' => 'sometimes|boolean',
            'role_id' => 'required|exists:roles,id',
        ];
    }

    /**
     * Validation rules for updating a user.
     */
    protected function update(): array
    {
        $model = request()->route('user');
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $model->id,
            'password' => 'sometimes|string|min:6',
            'is_active' => 'sometimes|boolean',
            'role_id' => 'required|exists:roles,id',
            '_method' => 'required|in:put',
        ];
    }

    /**
     * Additional rules based on the authenticated guard.
     */
    protected function guardSpecificRules(): array
    {
        if (\Auth::guard('admin')->check()) {
            return [
                'company_id' => 'required|exists:companies,id',
            ];
        }

        return [];
    }
}
