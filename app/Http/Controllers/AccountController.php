<?php

namespace App\Http\Controllers;

use App\Http\Requests\Account\CreateAccountRequest;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
}
