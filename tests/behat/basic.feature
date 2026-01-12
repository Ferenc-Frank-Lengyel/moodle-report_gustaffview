@report @report_gustaffview
Feature: Basic tests for Student MyGrades Staff View 2.0 (Beta)

  @javascript
  Scenario: Plugin report_gustaffview appears in the list of installed additional plugins
    Given I log in as "admin"
    When I navigate to "Plugins > Plugins overview" in site administration
    And I follow "Additional plugins"
    Then I should see "Student MyGrades Staff View 2.0 (Beta)"
    And I should see "report_gustaffview"
