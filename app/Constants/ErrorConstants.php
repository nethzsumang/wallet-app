<?php
namespace App\Constants;

/**
 * Error Constants
 * @author kennethsumang@outlook.com
 */
class ErrorConstants
{
    const BAD_REQUEST = 'Bad Request';
    const UNAUTHORIZED = 'Unauthorized';
    const FORBIDDEN = 'Forbidden';
    const NOT_FOUND = 'Not Found';
    const METHOD_NOT_ALLOWED = 'Method Not Allowed';
    const UNPROCESSABLE_ENTITY = 'Unprocessable Entity';
    const INTERNAL_SERVER_ERROR = 'Internal Server Error';
    const CONFLICT = 'Conflict';

    const ERROR_CODES = [
        self::BAD_REQUEST => 400,
        self::UNAUTHORIZED => 401,
        self::FORBIDDEN => 403,
        self::NOT_FOUND => 404,
        self::METHOD_NOT_ALLOWED => 405,
        self::CONFLICT => 409,
        self::UNPROCESSABLE_ENTITY => 422,
        self::INTERNAL_SERVER_ERROR => 500
    ];
}