Feature:
  In order to check the correctness of the site
  As a tester
  I need to check right link is sended for all products


  Scenario Outline: rigth links will be sended for all products
    Given i am authorised as "vasilisa_test_a1qa@mail.ru" "TESTa1qa"
    When i am on downloads tab
    And i try to download product "<product>" for "<os>"
    And i want to send it by email
    Then i should receive a message with right link

  Examples:
  | os | product |
  | Windows | Total Security |
  | Windows | Anti-Virus |
  | Windows | Internet Security |
  | Windows | Safe Kids |
  | Windows | Password Manager |
  | Mac | Internet Security |
  | Mac | Password Manager |
  | Mac | Safe Kids |
  | Android | Internet Security |
  | Android | Safe Kids |
  | Android | Password Manager |
  | iOS | Safe Kids |
  | iOS | Password Manager |






