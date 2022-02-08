<?php
namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * UserService class
 * @author Kenneth Sumang
 */
class UserService extends BaseService
{
    /** @var UserRepository */
    private UserRepository $userRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    final public function register(array $data) : JsonResource
    {
        $user = $this->userRepository->create($data);
        return new JsonResource($user);
    }
}