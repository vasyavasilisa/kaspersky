<?php

use Application\Email;
use Codeception\Util\Fixtures;
use Page\KasperskyLoginPage;
use Page\KasperskyDownloadsPage;
use Page\KasperskyMainPage;
use Application\Antivirus;
use PHPUnit\Framework\Assert;

/**
 * Class KasperskiTest
 */
class KasperskiTester
{

    const SEARCH_LNK_KEY = "Download";
    const SEARCH_LNK_TEMPLATE = "/https:\/\/[0-9a-zA-z._+?&\/]+/";
    const FIXTURE_PRODUCT = "product";
    const FIXTURE_LOGIN = "login";

    /**
     * @var AcceptanceTester
     */
    private $I;


    /**
     * KasperskiTester constructor.
     * @param AcceptanceTester $I
     */
    function __construct(AcceptanceTester $I)
    {
        $this->I = $I;
    }

    /**
     * @Given i am authorised as :arg1 :arg2
     */
    public function iAmAuthorisedAs($login, $password)
    {
        Fixtures::add(self::FIXTURE_LOGIN, $login);
        $loginPage = new KasperskyLoginPage($this->I);
        $loginPage->login($login, $password);
    }

  
}
