<?php

namespace Tests\Feature;

use App\Http\Requests\User\RegisterUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

/**
 * RegisterUserTest class
 * @author Kenneth Sumang
 */
class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    private $registerUri = '';

    public function __construct()
    {
        parent::__construct();
        $this->registerUri = config('app.APP_URL') . '/api/users';
    }

    /**
     * Test for valid data
     *
     * @return void
     */
    public function testValidData()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(200);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'username',
                    'email',
                    'created_at',
                    'updated_at'
                ]
            ]);
        });
    }

    /**
     * Tests for missing name
     */
    public function testMissingName()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(400);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
        $response->assertJsonPath('error.code', 400);
    }

    /**
     * Tests for missing username
     */
    public function testMissingUsername()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(400);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }

    /**
     * Tests for missing email
     */
    public function testMissingEmail()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(400);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }

    /**
     * Tests for missing password
     */
    public function testMissingPassword()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com'
            ]
        );
        $response->assertStatus(400);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }

    /**
     * Test for duplicate username
     *
     * @return void
     */
    public function testDuplicateUsername()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin2@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(409);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }

    /**
     * Test for duplicate email
     *
     * @return void
     */
    public function testDuplicateEmail()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin2',
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(409);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }

    /**
     * Test for weak password
     */
    public function testWeakPassword()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'username' => 'admin2',
                'email' => 'admin@example.com',
                'password' => 'admin'
            ]
        );
        $response->assertStatus(400);
        $response->assertJson(static function (AssertableJson $json) {
            $json->assertJsonStructure([
                'error' => [
                    'code',
                    'message',
                    'data'
                ]
            ]);
        });
    }
}
