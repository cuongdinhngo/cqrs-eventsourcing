<?php

use Behat\Behat\Context\Context;
use Tests\TestCase;

/**
 * Defines application features from the specific context.
 */
class BeHatContext extends TestCase implements Context
{
    protected $content;

    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->setUp();
    }

    /**
     * @Given I am on the homepage
     */
    public function iAmOnHomepage()
    {
        $this->get('/');
    }

    /**
     * @Then I should be able to do something with Behat
     */
    public function iShouldBeAbleToDoSomethingWithBehat()
    {
        $this->assertEquals('testing_app', env('DB_DATABASE'));
        $this->assertEquals('acceptance', env('APP_ENV'));
    }
}
