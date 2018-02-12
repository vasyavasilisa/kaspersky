<?php

namespace Page;


class KasperskyDownloadsPage
{
    private static $downloadsArea = "//div[@class='w-downloadedSoft']";
    private static $osBtn = "//div[@class='u-osTile__title' and contains(text(),'%s')]/ancestor::div[contains(@class,'u-osTile')]";
    private static $osAttribute = "data-os";
    private static $productDownloadBtn = "//div[@data-os-type='%s']/ancestor::div[@aria-hidden='false']/descendant::div[contains(text(),'%s')]/ancestor::div[@class='w-downloadProgramCard__logo']/following-sibling::button[contains(@data-url, 'Download')]";
    private static $sendLinkByEmailBtn = "//div[@class='w-downloadProductCard__sendLink']//button[@data-omniture-cta-name='Send installer link to email']";
    private static $sendOnDisplayedEmailBtn = '//div[@class="w-masterAccountForm__cell"]/button[contains(@class,"u-button")]';
    private static $successLbl = '//div[contains(@class,"js-success-send-modal")]//*[contains(text(),"%s")]';


    /**
     * @var AcceptanceTester
     */
    private $I;

    public function __construct(\AcceptanceTester $I)
    {
        $this->I = $I;
    }

    public function clickToDownload($product)
    {
        $osBtn = sprintf(self::$osBtn, $product->getOs());
        $osType = $this->I->grabAttributeFrom($osBtn, self::$osAttribute);
        $productDownloadBtn = sprintf(self::$productDownloadBtn, $osType, $product->getName());

        $this->I->downloadProductForOs(self::$downloadsArea, $osBtn, $productDownloadBtn, 20);
    }

    public function clickToSendLinkByEmail()
    {
        $this->I->click(self::$sendLinkByEmailBtn);
        $this->I->click(self::$sendOnDisplayedEmailBtn);
    }

    public function assertLinkWasSended($email)
    {
        $this->I->seeElement(sprintf(self::$successLbl, $email));

    }
}
