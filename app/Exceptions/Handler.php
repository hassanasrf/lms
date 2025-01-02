<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
// use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if($exception instanceof AuthenticationException){
            return errorResponse('you are not authenticated. Please login.', 401);
        }
        if ($exception instanceof UnauthorizedException) {
            return errorResponse('User does not have the right permissions.', 403);
        }
        if($exception instanceof ValidationException){
            return errorResponse($exception->getMessage(), 422, $exception->errors());
        }
        if($exception->getMessage() == 'Authorization Required'){
            return errorResponse($exception->getMessage(),401);
        }
        if($exception->getMessage() == 'App Credentials missing. Contact Admin'){
            return errorResponse($exception->getMessage(),404);
        }
        if($exception->getMessage() == 'App Credentials are invalid, Access Denied'){
            return errorResponse($exception->getMessage(),401);
        }
        if($exception instanceof ModelNotFoundException){
            return errorResponse($exception->getMessage(), 404);
        }
        if ($exception instanceof NotFoundHttpException) {
            return errorResponse('The specified URL cannot be found.', 404);
        }
        if ($exception instanceof AuthorizationException) {
            return errorResponse($exception->getMessage(), 403);
        }
        if ($exception instanceof MethodNotAllowedHttpException) {
            return errorResponse($exception->getMessage(), 405);
        }
        return errorResponse($exception->getMessage(), 500, config('app.debug') ? $exception->getTrace() : []);
    }
}
