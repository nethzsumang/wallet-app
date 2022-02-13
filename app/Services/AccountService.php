<?php
namespace App\Services;

use App\Http\Resources\Account\AccountResource;
use App\Repositories\AccountRepository;
use App\Repositories\AccountSummaryRepository;
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

    /** @var AccountSummaryRepository */
    private AccountSummaryRepository $accountSummaryRepository;

    /**
     * AccountService constructor.
     * @param AccountRepository $accountRepository
     * @param AccountSummaryRepository $accountSummaryRepository
     */
    public function __construct(AccountRepository $accountRepository, AccountSummaryRepository $accountSummaryRepository)
    {
        $this->accountRepository = $accountRepository;
        $this->accountSummaryRepository = $accountSummaryRepository;
    }

    /**
     * Create a new account
     * @param array $data
     * @return JsonResource
     */
    final public function createAccount(array $data): JsonResource
    {
        $amount = Arr::pull($data, 'amount');
        $account = $this->accountRepository->create($data);
        $latestInsertedId = $account->id;
        $this->accountSummaryRepository->create([
            'account_id' => $latestInsertedId,
            'amount' => $amount,
            'date' => date('Y-m-d')
        ]);
        return new AccountResource($account);
    }
}