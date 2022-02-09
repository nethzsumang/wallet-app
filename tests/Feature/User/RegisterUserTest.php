<?php

namespace Tests\Feature;

use App\Http\Requests\User\RegisterUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Passport\Passport;
use Tests\TestCase;

/**
 * RegisterUserTest class
 * @author Kenneth Sumang
 */
class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    private $registerUri = '';

    public function setUp(): void
    {
        parent::setUp();
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
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'username',
                'email',
                'created_at',
                'updated_at'
            ]
        ]);
    }

    /**
     * Tests for missing name
     */
    public function testMissingName()
    {
        $response = $this->post(
            $this->registerUri,
            [
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error' => [
                'code',
                'message',
                'data'
            ]
        ]);
        $response->assertJsonPath('error.code', 400);
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
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error' => [
                'code',
                'message',
                'data'
            ]
        ]);
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
                'email' => 'admin@example.com'
            ]
        );
        var_dump($response->json());
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error' => [
                'code',
                'message',
                'data'
            ]
        ]);
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
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response = $this->post(
            $this->registerUri,
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'Admin123!'
            ]
        );
        $response->assertStatus(409);
        $response->assertJsonStructure([
            'error' => [
                'code',
                'message',
                'data'
            ]
        ]);
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
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'admin'
            ]
        );
        $response->assertStatus(400);
        $response->assertJsonStructure([
            'error' => [
                'code',
                'message',
                'data'
            ]
        ]);
    }
}
