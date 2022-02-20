<?php
namespace App\Repositories;

use App\Models\Account;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

/**
 * AccountRepository class
 * @author Kenneth Sumang
 */
class AccountRepository extends BaseRepository
{
    /**
     * AccountRepository constructor
     * @param Account $account
     */
    public function __construct(Account $account)
    {
        parent::__construct($account);
    }

    /**
     * Gets account with summary
     * @param int $accountId
     * @return Account
     */
    final public function getAccountWithSummaries(int $accountId) : Account
    {
        return $this->model
            ->with('accountSummaries')
            ->where('id', $accountId)
            ->first();
    }

    /**
     * Gets accounts based on filters (with latest account summary)
     * @param array $filters
     * @return LengthAwarePaginator
     */
    final public function getAccounts(array $filters) : LengthAwarePaginator
    {
        $columns = $this->formatColumns();
        return $this->model
            ->select($columns)
            ->with([
                'latestAccountSummary' => static function ($query) {
                    $query
                        ->select('id', 'account_id', 'amount', 'date')
                        ->orderBy('date', 'desc');
                }
            ])
            ->when(Arr::has($filters, 'user_id'), static function ($query) use($filters) {
                $userId = Arr::get($filters, 'user_id');
                return $query->where('user_id', $userId);
            })
            ->when(Arr::has($filters, 'name'), static function ($query) use($filters) {
                $name = Arr::get($filters, 'name');
                return $query->where('name', 'like', "%{$name}%");
            })
            ->orderBy(...$this->orderResults())
            ->paginate($this->paginateResults());
    }
}