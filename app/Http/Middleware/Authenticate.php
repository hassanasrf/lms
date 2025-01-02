<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use JWTAuth;

class Authenticate
{
    /**
    * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try {
            Auth::shouldUse($guard);
            $user = JWTAuth::parseToken()->authenticate();
            if (Auth::guard($guard)->guest()) {
                if (!$request->ajax() || !$request->wantsJson()) {
                    return errorResponse('You are not authorized.', 401);
                } else {
                    if (!(\Request::is('api/*'))) {
                        return redirect()->guest('/login');
                    }
                }
            }
        } catch (\Exception $e) {

            $catchResponse = [];
            if ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException) {
                $catchResponse = errorResponse('Token is Expired', 498);
            } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException) {

                $catchResponse = errorResponse('Token is Invalid', 401);
            } elseif ($e instanceof \PHPOpenSourceSaver\JWTAuth\Exceptions\TokenBlacklistedException) {
                $catchResponse = errorResponse('The token has been blacklisted', 148);
            } else {
                $catchResponse = errorResponse('You are not authorized.', 401);
            }
            return $catchResponse;
        }
        return $next($request);
    }
}
