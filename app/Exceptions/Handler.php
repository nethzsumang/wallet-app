<?php

namespace App\Exceptions;

use App\Constants\ErrorConstants;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Exceptions\OAuthServerException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        BadRequestException::class,
        NotFoundException::class,
        ServerErrorException::class,
        UnauthorizedException::class,
        ForbiddenException::class,
        ValidationException::class,
        ConflictException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (BadRequestException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::BAD_REQUEST],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::BAD_REQUEST]
            );
        });

        $this->renderable(function (ValidationException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::BAD_REQUEST],
                    $e->getMessage(),
                    $e->errors()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::BAD_REQUEST]
            );
        });

        $this->renderable(function (NotFoundException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND]
            );
        });

        $this->renderable(function (ServerErrorException|QueryException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::INTERNAL_SERVER_ERROR],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::INTERNAL_SERVER_ERROR]
            );
        });

        $this->renderable(function (UnauthorizedException | AuthenticationException | OAuthServerException | AccessDeniedHttpException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::UNAUTHORIZED],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::UNAUTHORIZED]
            );
        });

        $this->renderable(function (ForbiddenException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::FORBIDDEN],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::FORBIDDEN]
            );
        });

        $this->renderable(function (ConflictException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::CONFLICT],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::CONFLICT]
            );
        });

        $this->renderable(function (RouteNotFoundException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND],
                    $e->getMessage()
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND]
            );
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json(
                $this->getErrorData(
                    ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND],
                    request()->path() . ' not found.'
                ),
                ErrorConstants::ERROR_CODES[ErrorConstants::NOT_FOUND]
            );
        });
    }

    /**
     * Gets error data for JSON response
     * @param int $code
     * @param string $message
     * @return array
     */
    private function getErrorData(int $code, string $message, array $data = []) : array
    {
        return [
            'status' => $code,
            'message' => $message,
            'data' => $data,
            'timestamp' => now()->toDateTimeString()
        ];
    }
}
