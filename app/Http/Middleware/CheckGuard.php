<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class CheckGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard)
    {
        try {
            // Parse the token and authenticate with the specified guard
            JWTAuth::setToken(JWTAuth::getToken());
            $payload = JWTAuth::getPayload();

            // Check if the token's "guard" claim matches the current guard
            if ($payload->get('guard') !== $guard) {
                return errorResponse('Unauthorized access', 403);
            }

            // Explicitly set the guard and authenticate
            auth()->shouldUse($guard);
            $user = auth()->user();

            if (!$user) {
                return errorResponse('User not found', 401);
            }

        } catch (\Exception $e) {
            return errorResponse('Token is invalid or expired', 401);
        }

        return $next($request);
    }
}
