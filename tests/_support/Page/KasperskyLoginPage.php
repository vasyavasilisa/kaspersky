<?php

namespace Page;

class KasperskyLoginPage
{
    private static $invateBtn = "//div[@class='signin-invite']//button";

    /**
     * @var AcceptanceTester
     */
    private $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function login($login, $password)
    {
        $I = $this->tester;
        $I->amOnPage('/');
        $I->click(self::$invateBtn);
        $I->login($login, $password);
    }

}
