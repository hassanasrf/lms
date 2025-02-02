<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Domain;
use App\Models\Subdomain;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\BaseController;
use App\Http\Resources\UserProfileResource;

class AuthController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $guard = request()->segment(2) === 'company' ? 'api' : request()->segment(2);
            $credentials = $request->only(['email', 'password']);

            // Get domain and subdomain from the request
            $domain = $request->input('domain');
            $subdomain = $request->input('subdomain');

            if ($guard === 'api') {
                if (!$this->isValidDomainAndSubdomain($domain, $subdomain, $guard)) {
                    return errorResponse(Constant::MESSAGE_INVALID_DOMAINS, 422);
                }
            }

            if (!$token = auth($guard)->claims(['guard' => $guard])->attempt($credentials)) {
                return errorResponse(Constant::MESSAGE_INVALID_CREDENTIALS, 422);
            }

            $user = auth()->guard($guard)->user();

            if (!$user->is_active) {
                return errorResponse(Constant::MESSAGE_DEACTIVATED, 403);
            }

            $success = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL(),
                'user' => new UserProfileResource($user),
            ];

            return successResponse($success, Constant::MESSAGE_LOGIN);

        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Validate domain and subdomain to ensure it's for the correct company.
     */
    private function isValidDomainAndSubdomain(string $domain, string $subdomain, string $guard): bool
    {
        $email = request()->email;
        $user = User::where('email', $email)->first();

        // Check if the user exists
        if (!$user) {
            return false;
        }

        $domain = Domain::where('name', $domain)
            ->where('company_id', $user->company_id)
            ->first();

        $subdomainExists = Subdomain::where('name', $subdomain)
            ->where('company_id', $user->company_id)
            ->exists();

        return $domain && $subdomainExists;
    }

    /**
     * Get Profile
     * @authenticated
    */
    public function getProfile(): JsonResponse
    {
        try{
            return successResponse(UserProfileResource::make(auth()->user()), Constant::MESSAGE_FETCHED);
        }catch (Exception $e){
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Logout
     * @authenticated
     */
    public function logout(): JsonResponse
    {
        $this->guard()->logout();
        return successResponse(true, Constant::MESSAGE_LOGOUT);
    }
}
