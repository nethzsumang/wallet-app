<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Exceptions\ConflictException;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Validator;

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

    /**
     * Register a new user
     * @param array $data
     * @return JsonResource
     * @throws ConflictException
     */
    final public function register(array $data) : JsonResource
    {
        $this->checkUniqueFields($data);
        $user = $this->userRepository->create($data);
        return new JsonResource($user);
    }

    /**
     * Checks unique fields in user data
     * @param array $data
     * @return void
     * @throws ConflictException
     */
    private function checkUniqueFields(array $data) : void
    {
        $validator = Validator::make(
            $data,
            [
                'email' => 'unique:users,email',
                'username' => 'unique:users,username'
            ]
        );
        if ($validator->fails()) {
            throw new ConflictException($validator->errors()->first());
        }
    }
}