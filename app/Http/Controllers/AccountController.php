<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\SearchAccountsRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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

    /**
     * Create a new account
     * @param CreateAccountRequest $request
     * @return JsonResource
     */
    final public function createAccount(CreateAccountRequest $request) : JsonResource
    {
        $data = $request->validated();
        return $this->accountService->createAccount($data);
    }

    /**
     * Get all accounts
     */
    final public function getAccounts(SearchAccountsRequest $request) : ResourceCollection
    {
        $data = $request->validated();
        return $this->accountService->getAccounts($data);
    }
}
