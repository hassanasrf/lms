<?php

namespace App\Http\Middleware;

use PHPOpenSourceSaver\JWTAuth\Http\Middleware\BaseMiddleware;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Closure;
use Exception;

class JwtTokenRefresh extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = JWTAuth::getToken();
            $token = JWTAuth::refresh($token);
            JWTAuth::setToken($token)->touser();
            $request->headers->set('Authorization', 'Bearer ' . $token);
        } catch (\JWTException $e) {
            return errorResponse($e->getMessage(), 401);
        } catch (\Exception $e) {
            return errorResponse($e->getMessage(), 401);
        }
        return $next($request);
    }
}
