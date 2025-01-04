<?php

namespace App\Http\Controllers\Api;

use App\Models\Admin;
use App\Helpers\Constant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\BaseController;

/**
 * @group Auth
 *
 * APIs for managing users
 */

class AuthController extends BaseController
{
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $credentials = $request->only(['email', 'password']);

            if ($token = $this->guard()->attempt($credentials)) {
                $this->user = $this->guard()->user();

                if (!$token = auth()->guard(request()->segment(2))->attempt($credentials)) {
                    return errorResponse(Constant::MESSAGE_UNAUTHORIZED, 401);
                }

                if (!$this->user->is_active) {
                   return errorResponse(Constant::MESSAGE_DEACTIVATED, 403);
                }

                $success['token'] = $token;
                $success['user'] = $this->user;

                return successResponse($success, Constant::MESSAGE_LOGIN);
            } else {
                return errorResponse(Constant::MESSAGE_INVALID_CREDENTIALS, 422);
            }
        }
        catch (Exception $e) {
            return errorResponse($e->getMessage(),$e->getCode());
        }
    }

    /**
     * Get Profile
     *
     * @authenticated
     * @response {
     *     "success": true,
     *     "status": 200,
     *     "message": [
     *         "Record fetched successfully."
     *     ],
     *     "data": {
     *         "id": "98af6b90-6047-4577-9343-d584370e6ee6",
     *         "name": "Test",
     *         "email": "dev@admin.com",
     *         "status": 1,
     *         "created_at": "2023-03-14T11:05:13.000000Z",
     *         "updated_at": "2023-03-14T11:05:13.000000Z",
     *         "deleted_at": null
     *     }
     * }
    */
    public function getProfile(): JsonResponse
    {
        try{
            $user = auth()->user();
            return successResponse($user, Constant::MESSAGE_FETCHED);
        }catch (Exception $e){
            return errorResponse($e->getMessage(),$e->getCode());
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
