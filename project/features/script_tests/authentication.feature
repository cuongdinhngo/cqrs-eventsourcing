Feature: Authentication

    Background:
        Given a user named "adam" exists

    Scenario: Login in successfully to my website
        Given I login as "adam_dummy_test@mailinator.com" with password "123456"
        Then the response status code should be 200

    Scenario: Attempt to login with invalid credentials
        Given I login as "dummy_test@mailinator.com" with password "0000000"
        Then I should see "Login"