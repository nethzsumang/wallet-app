<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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

    /**
     * Gets users based on filters
     * @param array $filters
     * @return Collection
     */
    final public function getUsers(array $filters) : LengthAwarePaginator
    {
        return $this->model
            ->when(Arr::has($filters, 'name'), static function ($query) use($filters) {
                $name = Arr::get($filters, 'name');
                return $query->where('name', 'like', "%{$name}%");
            })
            ->when(Arr::has($filters, 'id'), static function ($query) use($filters) {
                $id = Arr::get($filters, 'id');
                return $query->where('id', $id);
            })
            ->when(Arr::has($filters, 'email'), static function ($query) use($filters) {
                $email = Arr::get($filters, 'email');
                return $query->where('email', $email);
            })
            ->orderBy(Arr::get($filters, 'sortkey', 'id'), Arr::get($filters, 'sortdir', 'asc'))
            ->paginate(request()->get('limit', 10));
    }
}