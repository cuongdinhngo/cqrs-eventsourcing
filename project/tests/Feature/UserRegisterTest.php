<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class UserRegisterTest extends TestCase
{
    protected $table;

    public function setUp():void
    {
        parent::setUp();
        $this->table = (new User())->getTable();
        $this->truncateTable($this->table);
    }

    /**
     * TearDown the test environment.
     *
     * @return void
     */
    public function tearDown(): void
    {
        $this->truncateManyTables();
        parent::tearDown();
    }

    public function jsonRequestUserRegister(array $data)
    {
        return $this->json('POST', 'api/users', $data);
    }

    /**
     * Test user register successfully
     *
     * @return void
     */
    public function testUserRegisterSuccessfully()
    {
        $data = [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
            "password" => "123456",
        ];
        $response = $this->jsonRequestUserRegister($data);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Created Successfully']);
        $this->assertDatabaseHas($this->table, [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
        ]);
    }

    /**
     * Test user register via failed validation
     *
     * @return void
     */
    public function testUserRegisterFailValidation()
    {
        $data = [
            "name" => "Mr Dummy Test",
        ];
        $response = $this->jsonRequestUserRegister($data);

        $response->assertStatus(422);
        $response->assertJson(['message' => "Failed Validation"]);
        $this->assertDatabaseMissing($this->table, [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
        ]);
    }
}
