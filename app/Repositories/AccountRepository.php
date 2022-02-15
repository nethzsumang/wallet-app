<?php
namespace App\Repositories;

use App\Models\Account;

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
}