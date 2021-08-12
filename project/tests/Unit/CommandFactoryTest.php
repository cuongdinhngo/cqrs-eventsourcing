<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CommandHandlers\CommandFactory;
use App\CommandHandlers\User\UserRegisterCommand;
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

        $result = app(CommandFactory::class)->handle(UserRegisterCommand::class, $this->data);
        
        $this->assertTrue($result);
    }
}
