<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Facades\CommandFactory;
use App\CommandHandlers\Handlers\User\UserRegisterCommand;
use Illuminate\Support\Facades\Event;
use App\Models\User;

class CommandFactoryTest extends TestCase
{
    protected $data = [
        "name" => "Mr Dummy Test",
        "email" => "dummy_test@mailinator.com",
        "password" => "123456",
    ];

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

    /**
     * Test Command Handle
     *
     * @return void
     */
    public function testCommandHandle()
    {
        Event::fake();

        $result = CommandFactory::handle(UserRegisterCommand::class, $this->data);
        
        $this->assertTrue($result);
    }
}
