Feature: Login
    Background:
        Given a user called "Alan" exists
        And a user called "Bob" exists
        And a user called "Clare" exists
        And a user called "Derek" exists
        And a user called "Eric" exists

    Scenario: Log in as Alan
        Given I am logged in as "Alan"
        And I come to the path "/home"
        Then I see the text "You are logged in"

    Scenario: Log in as Bob
        Given I am logged in as "Bob"
        And I come to the path "/"
        Then I see the text "Laravel"

    Scenario: Log in as Clare
        Given I am logged in as "Clare"
        And I come to the path "/home"
        Then I see the text "You are logged in"

    Scenario: Log in as Derek
        Given I am logged in as "Derek"
        And I come to the path "/home"
        Then I see the text "You are logged in"

    Scenario: Log in as Eric
        Given I am logged in as "Eric"
        And I come to the path "/home"
        Then I see the text "You are logged in"