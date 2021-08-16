Feature: Authentication

    Background:
        Given a user called "adam" exists

    Scenario: Login in successfully to my website
        Given I login as "adam_dummy_test@mailinator.com" with password "123456"
        Then I should see "You are logged in"

    Scenario: Attempt to login with invalid credentials
        Given I login as "dummy_test@mailinator.com" with password "0000000"
        Then I should see "Login"