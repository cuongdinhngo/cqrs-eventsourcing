Feature: Example Test
    Scenario: Come to root path
        When I visit the path "/"
        Then I should see the text "Laravel"