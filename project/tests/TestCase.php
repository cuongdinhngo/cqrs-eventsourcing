<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $tables = [
        'users'
    ];

    protected $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp():void
    {
        parent::setUp();
        $this->prepareDatabaseTest();
    }

    /**
     * TearDown the test environment.
     *
     * @return void
     */
    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * Prepare database test
     *
     * @return void
     */
    public function prepareDatabaseTest()
    {
        Artisan::call("migrate");
        if (!$this->user) {
            $this->user = $this->createDummyUser();
        }
    }

    /**
     * Create dummy user
     *
     * @return void
     */
    public function createDummyUser()
    {
        return factory(User::class)->create(
            [
                "name" => "Mr Dummy Test",
                "email" => "dummy_test@mailinator.com",
                "password" => "123456",
                "api_token" => generateApiToken()
            ]
        );
    }

    /**
     * Truncate many tables
     *
     * @return void
     */
    public function truncateManyTables()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Truncate specified tabled
     *
     * @param string $table
     * @return void
     */
    public function truncateTable(string $table)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table($table)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
