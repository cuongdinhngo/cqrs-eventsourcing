<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CommandHandlers\User\UserCommon;
use App\Models\User;

class UserCommonTest extends TestCase
{
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
        $request = [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
            "password" => "123456",
        ];
        $userCommon = new UserCommon();
        $preparedData = $userCommon->prepareData($request);
        $this->assertCount(4, $preparedData);
        $this->assertArrayHasKey('api_token', $preparedData);
        $this->assertNotEquals($preparedData['password'], $request['password']);
        $this->assertNotNull($preparedData['password']);
    }

    /**
     * Test prepare data with password
     *
     * @return void
     */
    public function testPrepareUpdateDataWithPassword()
    {
        $request = [
            "name" => "Mr Dummy Test",
            "email" => "dummy_test@mailinator.com",
            "password" => "123456",
        ];
        $userCommon = new UserCommon();
        $preparedData = $userCommon->prepareUpdateData($request);
        $this->assertCount(3, $preparedData);
        $this->assertArrayNotHasKey('api_token', $preparedData);
        $this->assertNotEquals($preparedData['password'], $request['password']);
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
