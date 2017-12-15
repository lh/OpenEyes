@laserModule
Feature: Create New Laser event
  In order to cover every possible route throughout the site
  As an automation tester
  I want to build a template with supporting code for each web page

  Scenario: Route 1: Login and create a Laser Module event

    Given I am on the OpenEyes "master" homepage
    And I enter login credentials "admin" and "admin"
    And I select Site "2"
    Then I select a firm of "3"

    Then I search for hospital number "1009465"

    Then I create a Laser Event
    #Then I expand the Glaucoma sidebar
    #And I add a New Event "Laser"

    #Then I select a Laser site ID "1"
#    And I select a Laser of "2"
#    And I select a Laser Surgeon of "2"
#    Then I select a Right Procedure of "62"
#    Then I select a Right Procedure of "177"
#    Then I select a Left Procedure of "363"
#    Then I select a Left Procedure of "128"
#
#    And I remove the last added Procedure
#
#    Then I save the Laser Event
