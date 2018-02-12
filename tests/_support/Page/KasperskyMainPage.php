<?php

namespace Page;

class KasperskyMainPage
{
    /**
     * @var AcceptanceTester
     */
    private $tester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->tester = $I;
    }

    public function goToDownloadsPage()
    {
        $I = $this->tester;
        $I->amOnPage('/MyDownloads');
    }

}
