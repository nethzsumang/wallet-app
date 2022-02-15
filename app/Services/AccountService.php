<?php
namespace App\Services;

use App\Http\Resources\Account\AccountResource;
use App\Repositories\AccountRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

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

    /**
     * Create a new account
     * @param array $data
     * @return JsonResource
     */
    final public function createAccount(array $data): JsonResource
    {
        Arr::forget($data, 'amount');
        $account = $this->accountRepository->create($data);
        $accountWithSummary = $this->accountRepository->getAccountWithSummaries($account->id);
        return new AccountResource($accountWithSummary);
    }
}