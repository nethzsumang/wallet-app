<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Requests\User\SearchUsersRequest;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * UserController class
 * @author Kenneth Sumang
 */
class UserController extends Controller
{
    protected UserService $userService;

    /**
     * UserController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register a new user
     * @param RegisterUserRequest $request
     */
    final public function registerUser(RegisterUserRequest $request) : JsonResource
    {
        $data = $request->validated();
        return $this->userService->register($data);
    }

    /**
     * Fetch users
     * @param SearchUsersRequest $request
     * @return ResourceCollection
     */
    final public function getUsers(SearchUsersRequest $request) : ResourceCollection
    {
        $filters = $request->validated();
        return $this->userService->getUsers($filters);
    }
}
