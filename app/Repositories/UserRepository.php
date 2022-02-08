<?php
namespace App\Repositories;

use App\Models\User;

/**
 * UserRepository class
 * @author Kenneth Sumang
 */
class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}