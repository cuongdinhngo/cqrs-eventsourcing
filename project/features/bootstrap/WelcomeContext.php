<?php

use Behat\Behat\Context\Context;
use Tests\TestCase;

/**
 * Defines application features from the specific context.
 */
class WelcomeContext extends TestCase implements Context
{
    /**
     * Initializes context.
     */
    public function __construct()
    {
        $this->setUp();
    }

    /**
     * @When I visit the path :path
     */
    public function iVisitThePath($path)
    {
        $response = $this->get($path);
        $this->assertEquals(200, $response->getStatusCode());
        $this->content = $response->getContent();
    }

    /**
     * @Then I should see the text :text
     */
    public function iShouldSeeTheText($text)
    {
        $this->assertStringContainsString($text, $this->content);
    }
}
