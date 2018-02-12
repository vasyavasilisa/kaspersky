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

    /**
     * @When i am on downloads tab
     */
    public function iAmOnDownloadsTab()
    {
        $mainPage = new KasperskyMainPage($this->I);
        $mainPage->goToDownloadsPage();
    }

    /**
     * @When i try to download product :arg1 for :arg2
     */
    public function iTryToDownloadProductFor($product, $os)
    {
        $antivirus = new Antivirus($os, $product);
        Fixtures::add(self::FIXTURE_PRODUCT, $product);
        $downloadsPage = new KasperskyDownloadsPage($this->I);
        $downloadsPage->clickToDownload($antivirus);
    }

    /**
     * @When i want to send it by email
     */
    public function iWantToSendItByEmail()
    {
        $downloadsPage = new KasperskyDownloadsPage($this->I);
        $downloadsPage->clickToSendLinkByEmail();
        $downloadsPage->assertLinkWasSended(Fixtures::get(self::FIXTURE_LOGIN));
    }

    /**
     * @Then i should receive a message with right link
     */
    public function iShouldReceiveAMessageWithRightLink()
    {
        $startWaitTime = time();
        $string = file_get_contents("config.json");
        $json_a = json_decode($string, true);
        $mailFrom = new Email(Fixtures::get(self::FIXTURE_LOGIN), $json_a['email']['host'], $json_a['email']['password']);
        $subject = $json_a['message']['subjectTemplate'] . Fixtures::get(self::FIXTURE_PRODUCT);
        $mailFrom->waitForMessageWithSubject($subject, $startWaitTime, $json_a['message']['maxWaitSec']);
        $connection = $mailFrom->getConnectionForFetching();
        $isMessagePresent = $mailFrom->isMessagePresent($connection, count($connection), self::SEARCH_LNK_TEMPLATE, self::SEARCH_LNK_KEY);
        Assert::assertNotEquals($isMessagePresent, FALSE, "Links are not equal");
    }
}