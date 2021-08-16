<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\CommandHandlers\Handlers\User\UserRegisterCommand;
use App\CommandHandlers\Handlers\User\UserCommon;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Repositories\UserRepository;

class UserRegisterCommandTest extends TestCase
{
    protected $userRegisterCommand;

    protected $data;

    protected $expectedData = [
        "email" => "dummy_test@mailinator.com",
        "name" => "Mr Dummy Test",
    ];

    public $request = [
        "name" => "Mr Dummy Test",
        "email" => "dummy_test@mailinator.com",
        "password" => "123456",
    ];

    protected $table;

    public function setUp():void
    {
        parent::setUp();
        $this->userRegisterCommand = app(UserRegisterCommand::class);
        $this->data = app(UserCommon::class)->prepareData($this->request);
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
     * Test create new user
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = $this->userRegisterCommand->createUser($this->data);
        $this->assertTrue($user instanceof User);
        $this->assertDatabaseHas($this->table, $this->expectedData);
    }

    /**
     * Test User Register Command execute
     *
     * @return void
     */
    public function testExecuteUserCommand()
    {
        $result = $this->userRegisterCommand->execute($this->data);
        $this->assertTrue($result);
    }

    /**
     * Test User Registered event
     *
     * @return void
     */
    public function testUserRegisteredEvent()
    {
        Event::fake();

        $this->userRegisterCommand->execute($this->data);

        Event::assertDispatched(Registered::class, function ($e){
            return $e->user->email === $this->expectedData['email'];
        });
    }
}
