<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CommandHandlers\Handlers\User\UserCommon;
use App\Models\User;

class UserCommonTest extends TestCase
{
    public $request = [
        "name" => "Mr Dummy Test",
        "email" => "dummy_test@mailinator.com",
        "password" => "123456",
    ];

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

    /**
     * Test prepare date for register
     *
     * @return void
     */
    public function testPrepareData()
    {
        $userCommon = new UserCommon();
        $preparedData = $userCommon->prepareData($this->request);
        $this->assertCount(4, $preparedData);
        $this->assertArrayHasKey('api_token', $preparedData);
        $this->assertNotEquals($preparedData['password'], $this->request['password']);
        $this->assertNotNull($preparedData['password']);
    }

    /**
     * Test prepare data with password
     *
     * @return void
     */
    public function testPrepareUpdateDataWithPassword()
    {
        $userCommon = new UserCommon();
        $preparedData = $userCommon->prepareUpdateData($this->request);
        $this->assertCount(3, $preparedData);
        $this->assertArrayNotHasKey('api_token', $preparedData);
        $this->assertNotEquals($preparedData['password'], $this->request['password']);
    }

    /**
     * Test prepare data without password
     *
     * @return void
     */
    public function testPrepareUpdateDataWithoutPassword()
    {
        $request = [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
        ];
        $userCommon = new UserCommon();
        $preparedData = $userCommon->prepareUpdateData($request);
        $this->assertCount(2, $preparedData);
        $this->assertArrayNotHasKey('api_token', $preparedData);
        $this->assertArrayNotHasKey('password', $preparedData);
    }
}
