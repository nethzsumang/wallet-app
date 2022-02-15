<?php
namespace App\Repositories;

use App\Models\AccountSummary;

/**
 * AccountSummaryRepository class
 * @author Kenneth Sumang
 */
class AccountSummaryRepository extends BaseRepository
{
    /**
     * AccountSummaryRepository constructor.
     * @param AccountSummary $accountSummary
     */
    public function __construct(AccountSummary $accountSummary)
    {
        parent::__construct($accountSummary);
    }
}