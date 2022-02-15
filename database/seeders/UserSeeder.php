<?php

namespace Database\Seeders;

use App\Services\UserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /** @var UserService */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userService->register([
            'name' => 'Admin',
            'password' => env('ADMIN_USER_PASSWORD'),
            'email' => 'admin@example.com'
        ]);
    }
}
