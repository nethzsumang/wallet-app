<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CheckCredentialsRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

/**
 * AuthController class
 * @author Kenneth Sumang
 */
class AuthController extends Controller
{
    /** @var UserService */
    private UserService $userService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Check credentials
     */
    final public function checkCredentials(CheckCredentialsRequest $request) : array
    {
        $data = $request->validated();
        return [ 'success' => true ];
    }
}
