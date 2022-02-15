<?php
namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Resources\Account\AccountResource;
use App\Repositories\AccountRepository;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

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
     * @throws NotFoundException
     */
    final public function createAccount(array $data): JsonResource
    {
        Arr::forget($data, 'amount');
        $this->checkUserId($data['user_id']);
        $account = $this->accountRepository->create($data);
        $accountWithSummary = $this->accountRepository->getAccountWithSummaries($account->id);
        return new AccountResource($accountWithSummary);
    }

    /**
     * Checks user id if it exists
     * @param int $userId
     * @return void
     * @throws NotFoundException
     */
    private function checkUserId(int $userId): void
    {
        $validator = Validator::make(
            [ 'user_id' => $userId ],
            [ 'user_id' => 'exists:users,id' ]
        );
        if ($validator->fails()) {
            throw new NotFoundException($validator->errors()->first());
        }
    }
}