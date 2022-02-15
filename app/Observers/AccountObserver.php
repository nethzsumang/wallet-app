<?php

namespace App\Observers;

use App\Models\Account;
use App\Repositories\AccountSummaryRepository;

/**
 * AccountObserver class
 * @author Kenneth Sumang
 */
class AccountObserver
{
    /** @var AccountSummaryRepository */
    private AccountSummaryRepository $accountSummaryRepository;

    /**
     * AccountObserver constructor.
     * @param AccountSummaryRepository $accountSummaryRepository
     */
    public function __construct(AccountSummaryRepository $accountSummaryRepository)
    {
        $this->accountSummaryRepository = $accountSummaryRepository;
    }

    /**
     * Created observer
     * @param Account $account
     */
    public function created(Account $account)
    {
        $amount = (float)request()->get('amount', 0);
        $accountId = $account->id;
        $date = date('Y-m-d');
        $this->accountSummaryRepository->create([
            'account_id' => $accountId,
            'date' => $date,
            'amount' => $amount,
        ]);
    }
}
