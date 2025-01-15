<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Route;

class RoleRequest extends BaseRequest
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

        // Merge role-specific rules
        return array_merge($rules, $this->adminSpecificRules());
    }

    protected function store()
    {
        return [
            'company_id' => $this->companyIdRules(),
            'name' => 'required',
            'permission' => 'required|array',
        ];
    }

    protected function update()
    {
        $model = request()->route('role');
        return [
            'company_id' => $this->companyIdRules(),
            'name' => 'required|unique:roles,name,' . $model->id,
            'permission' => 'required|array',
            'user_ids' => 'sometimes|array',
            '_method' => 'required|in:put',
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
}
