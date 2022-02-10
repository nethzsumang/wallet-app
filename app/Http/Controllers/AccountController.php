<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

/**
 * AccountController class
 * @author Kenneth Sumang
 */
class AccountController extends Controller
{
    /** @var AccountService */
    private AccountService $accountService;

    /**
     * AccountController constructor.
     * @param AccountService $accountService
     */
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    final public function createAccount()
    {
        // TODO: Implement createAccount() method.
    }
}
