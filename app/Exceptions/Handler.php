<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\Exceptions\MissingAbilityException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
        if ($exception instanceof ValidationException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => $exception->validator->errors()->first()], 409);
        } elseif ($exception instanceof NotFoundHttpException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'Route not found.'], 404);
        } elseif ($exception instanceof AuthenticationException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        } elseif ($exception instanceof MissingAbilityException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'No permission'], 403);
        } elseif ($exception instanceof PostTooLargeException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'File too large.'], 409);
        } elseif ($exception instanceof HttpException) {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'Internal error'], 500);
        } else {
            Log::info($exception);

            return response()->json(['success' => false, 'message' => 'Internal error'], 500);
        }

        return parent::render($request, $exception);
    }
}
