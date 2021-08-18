<?php

use Behat\Behat\Context\Context;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Behat\MinkExtension\Context\MinkContext;
use Illuminate\Support\Facades\DB;
use PHPUnit_Framework_Assert as PHPUnit;
use Behat\Behat\Context\SnippetAcceptingContext;


/**
 * Defines application features from the specific context.
 */
class LoginMinkContext extends MinkContext implements Context
{

    protected $content;

    /**
     * Initializes context.
     */
    public function __construct(string $table)
    {
        DB::table($table)->truncate();
    }

    /**
     * @Given a user named :user exists
     */
    public function aUserNamedExists($user)
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
      * @Given I login as :email with password :password
      */
      public function iLoginAsWithPassword($email, $password) {
        $this->visit("/login");
        $this->fillField("email", $email);
        $this->fillField("password", $password);
        $this->pressButton("Login");
    }
}
