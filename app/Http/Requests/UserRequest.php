<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     */
    public function rules(): array
    {
        $rules = $this->isMethod('POST') ? $this->storeRules() : $this->updateRules();

        // Merge role-specific rules
        return array_merge($rules, $this->adminSpecificRules());
    }

    /**
     * Get validation rules for creating a new user.
     */
    protected function storeRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_active' => 'sometimes|boolean',
            'company_id' => $this->companyIdRules(),
            'role_id' => $this->roleIdRules(),
        ];
    }

    /**
     * Get validation rules for updating an existing user.
     */
    protected function updateRules(): array
    {
        $userId = $this->route('user')->id;

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => 'sometimes|string|min:6',
            'is_active' => 'sometimes|boolean',
            'company_id' => $this->companyIdRules(),
            'role_id' => $this->roleIdRules(),
        ];
    }

    /**
     * Define validation rules for `company_id`.
     */
    protected function companyIdRules(): array
    {
        return [
            Rule::requiredIf($this->isAdminRequest()),
            Rule::exists('companies', 'id'),
        ];
    }

    /**
     * Define validation rules for `role_id`.
     */
    protected function roleIdRules(): array
    {
        $companyId = $this->getCompanyId();

        return [
            'required',
            Rule::exists('roles', 'id')->where('company_id', $companyId),
        ];
    }

    /**
     * Additional admin-specific rules.
     */
    protected function adminSpecificRules(): array
    {
        if ($this->isAdminRequest()) {
            return [
                'company_id' => 'required|exists:companies,id',
            ];
        }

        return [];
    }

    /**
     * Check if the current request is from an admin.
     */
    protected function isAdminRequest(): bool
    {
        return auth()->guard('admin')->check();
    }

    /**
     * Retrieve the company ID for the request.
     */
    protected function getCompanyId(): ?int
    {
        if ($this->isAdminRequest()) {
            return $this->input('company_id');
        }

        return auth()->user()?->company_id;
    }
}
