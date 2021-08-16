<?php

use Behat\Behat\Context\Context;
use Tests\TestCase;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;


/**
 * Defines application features from the specific context.
 */
class LoginContext extends TestCase implements Context
{
    // use WithoutMiddleware;

    protected $content;


    /**
     * Initializes context.
     */
    public function __construct(string $table)
    {
        $this->truncateTable($table);
        $this->setUp();
    }

    /**
     * @Given I come to the path :path
     */
    public function iComeToThePath($path)
    {
        $response = $this->get($path);
        $this->assertEquals(200, $response->getStatusCode());
        $this->content = $response->getContent();
    }

    /**
     * @Then I see the text :text
     */
    public function iSeeTheText($text)
    {
        $this->assertStringContainsString($text, $this->content);
    }

    /**
     * @Given a user called :user exists
     */
    public function aUserCalledExists($user)
    {
        $data = [
            'name' => $user,
            "email" => "{$user}_dummy_test@mailinator.com",
            "password" => Hash::make("123456"),
            "api_token" => generateApiToken()
        ];

        $user = factory(User::class)->create($data);
    }

    /**
     * @Given I am logged in as :user
     */
    public function iAmLoggedInAs($user)
    {
        $user = User::where('name', $user)->first();
        $this->be($user);
    }
}
