<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;

class LoginRequest extends BaseRequest
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
    public function rules(Route $route): array
    {
        $prefix = $route->getPrefix();
        $isAdminRoute = Str::startsWith($prefix, 'api/admin');

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $rules['email'] .= $isAdminRoute ? '|exists:admins,email' : '|exists:users,email';

        if (!$isAdminRoute) {
            $rules['domain'] = 'required|string';
            $rules['subdomain'] = 'required|string';
        }

        return $rules;
    }

    /**
     * Get the body parameters for the request.
     *
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'email' => [
                'description' => 'The email address of the user.',
            ],
            'password' => [
                'description' => 'The password of the user.',
            ],
            'domain' => [
                'description' => 'The domain of the user, for example: "example.com".',
            ],
            'subdomain' => [
                'description' => 'The subdomain of the user, for example: "sub.example.com".',
            ],
        ];
    }
}
