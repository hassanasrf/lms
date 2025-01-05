<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
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
    }

    protected function store()
    {
        return [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array',
        ];
    }

    protected function update()
    {
        $model = request()->route('role');
        return [
            'name' => 'required|unique:roles,name,' . $model->id,
            'permission' => 'required|array',
            'user_ids' => 'sometimes|array',
            '_method' => 'required|in:put',
        ];
    }
}
