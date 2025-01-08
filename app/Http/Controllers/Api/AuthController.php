<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\BaseController;

class AuthController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            // Override segment(2) if it is 'company' to 'api'
            $guard = request()->segment(2) == 'company' ? 'api' : request()->segment(2);

            $credentials = $request->only(['email', 'password']);

            if ($token = $this->guard()->attempt($credentials)) {
                $this->user = $this->guard()->user();

                if (!$token = auth()->guard($guard)->attempt($credentials)) {
                    return errorResponse(Constant::MESSAGE_UNAUTHORIZED, 401);
                }

                if (!$this->user->is_active) {
                   return errorResponse(Constant::MESSAGE_DEACTIVATED, 403);
                }

                // Prepare success response
                $success = [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL(),
                    'user' => UserResource::make($this->user),
                ];

                return successResponse($success, Constant::MESSAGE_LOGIN);
            } else {
                return errorResponse(Constant::MESSAGE_INVALID_CREDENTIALS, 422);
            }
        } catch (Exception $e) {
            return errorResponse($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Get Profile
     * @authenticated
    */
    public function getProfile(): JsonResponse
    {
        try{
            return successResponse(UserResource::make(auth()->user()), Constant::MESSAGE_FETCHED);
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
