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
            $credentials = $request->only(['email', 'password']);

            // Attempt authentication using JWT
            if (!$token = auth()->attempt($credentials)) {
                return errorResponse(Constant::MESSAGE_INVALID_CREDENTIALS, 422);
            }

            // Get the authenticated user
            $this->user = auth()->user();

            // Check if the user is active
            if (!$this->user->is_active) {
                return errorResponse(Constant::MESSAGE_DEACTIVATED, 403);
            }

            // Prepare success response
            $success = [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL(),
                'user' => UserResource::make(auth()->user()),
            ];

            return successResponse($success, Constant::MESSAGE_LOGIN);
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
