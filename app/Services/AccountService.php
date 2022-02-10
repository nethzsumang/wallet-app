<?php
namespace App\Services;

use App\Repositories\AccountRepository;

/**
 * Class AccountService
 * @author Kenneth Sumang
 */
class AccountService extends BaseService
{
    /** @var AccountRepository */
    private AccountRepository $accountRepository;

    /**
     * AccountService constructor.
     * @param AccountRepository $accountRepository
     */
    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }
}