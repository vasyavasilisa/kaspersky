<?php

class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;
    /**
     * @Given I have product with $:num1:num2:num2 price in my cart
     */
    public function iHaveProductWithPriceInMyCart($num1, $num2, $num3)
    {
        throw new \Codeception\Exception\Incomplete("Step `I have product with $:num1:num2:num2 price in my cart` is not defined");
    }

    /**
     * @Given I have product with $:num1:num2:num2:num2 price in my cart
     */
    public function iHaveProductWithPriceInMyCart($num1, $num2, $num3, $num4)
    {
        throw new \Codeception\Exception\Incomplete("Step `I have product with $:num1:num2:num2:num2 price in my cart` is not defined");
    }

    /**
     * @When I go to checkout process
     */
    public function iGoToCheckoutProcess()
    {
        throw new \Codeception\Exception\Incomplete("Step `I go to checkout process` is not defined");
    }

    /**
     * @Then I should see that total number of products is :num1
     */
    public function iShouldSeeThatTotalNumberOfProductsIs($num1)
    {
        throw new \Codeception\Exception\Incomplete("Step `I should see that total number of products is :num1` is not defined");
    }

    /**
     * @Then my order amount is $:num1:num2:num3:num3
     */
    public function myOrderAmountIs($num1, $num2, $num3, $num4)
    {
        throw new \Codeception\Exception\Incomplete("Step `my order amount is $:num1:num2:num3:num3` is not defined");
    }

-----------------------------------------
5 snippets proposed
Copy generated snippets to AcceptanceTester or a specific Gherkin context

E:\PHP\codeception\vendor\bin>codecept dry-run acceptance myfeature.feature

Acceptance Tests (1) -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Modules: PhpBrowser, \Helper\Acceptance
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
checkout: order several products
Signature: myfeature:order several products
Test: tests\acceptance\myfeature.feature:order several products
Scenario --
In order to buy product
As a customer
I need to be able to checkout the selected products
Given i have product with $600 price in my cart
And i have product with $1000 price in my cart
When i go to checkout process
Then i should see that total number of products is 2
And my order amount is $1600

INCOMPLETE
Step definition for `I have product with $600 price in my cart` not found in contexts
Step definition for `I have product with $1000 price in my cart` not found in contexts
Step definition for `I go to checkout process` not found in contexts
Step definition for `I should see that total number of products is 2` not found in contexts
Step definition for `my order amount is $1600` not found in contexts
Run gherkin:snippets to define missing steps

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

E:\PHP\codeception\vendor\bin>codecept dry-run acceptance myfeature.feature

Acceptance Tests (1) -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
Modules: PhpBrowser, \Helper\Acceptance
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
checkout: order several products
Signature: myfeature:order several products
Test: tests\acceptance\myfeature.feature:order several products
Scenario --
In order to buy product
As a customer
I need to be able to checkout the selected products
Given i have product with $600 price in my cart
And i have product with $1000 price in my cart
When i go to checkout process
Then i should see that total number of products is 2
And my order amount is $1600

INCOMPLETE
Step definition for `I have product with $600 price in my cart` not found in contexts
Step definition for `I have product with $1000 price in my cart` not found in contexts
Step definition for `I go to checkout process` not found in contexts
Step definition for `I should see that total number of products is 2` not found in contexts
Step definition for `my order amount is $1600` not found in contexts
Run gherkin:snippets to define missing steps

----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

E:\PHP\codeception\vendor\bin>codecept gherkin:snippets acceptance
Snippets found in:
- \myfeature.feature
Generated Snippets:
-----------------------------------------
    /**
     * @Given I have product with $:num1:num2:num2 price in my cart
     */
    public function iHaveProductWithPriceInMyCart($num1, $num2, $num3)
    {
        throw new \Codeception\Exception\Incomplete("Step `I have product with $:num1:num2:num2 price in my cart` is not defined");
    }

    /**
     * @Given I have product with $:num1:num2:num2:num2 price in my cart
     */
    public function iHaveProductWithPriceInMyCart($num1, $num2, $num3, $num4)
    {
        throw new \Codeception\Exception\Incomplete("Step `I have product with $:num1:num2:num2:num2 price in my cart` is not defined");
    }

    /**
     * @When I go to checkout process
     */
    public function iGoToCheckoutProcess()
    {
        throw new \Codeception\Exception\Incomplete("Step `I go to checkout process` is not defined");
    }

    /**
     * @Then I should see that total number of products is :num1
     */
    public function iShouldSeeThatTotalNumberOfProductsIs($num1)
    {
        throw new \Codeception\Exception\Incomplete("Step `I should see that total number of products is :num1` is not defined");
    }

    /**
     * @Then my order amount is $:num1:num2:num3:num3
     */
    public function myOrderAmountIs($num1, $num2, $num3, $num4)
    {
        throw new \Codeception\Exception\Incomplete("Step `my order amount is $:num1:num2:num3:num3` is not defined");
    }

}