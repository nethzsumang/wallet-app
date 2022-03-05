<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Passport::routes();
        Passport::tokensCan([
            // user tokens
            'user_create' => 'Can create user',
            'user_read' => 'Can read user',
            'user_update' => 'Can update user',
            'user_delete' => 'Can delete user',

            // account tokens
            'account_create' => 'Can create account',
            'account_read' => 'Can read account',
            'account_update' => 'Can update account',
            'account_delete' => 'Can delete account',

            // record tokens
            'record_create' => 'Can create records',
            'record_read' => 'Can read records',
            'record_update' => 'Can update record',
            'record_delete' => 'Can delete records',
        ]);
    }
}
