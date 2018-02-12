<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
 */
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    private static $loginLogoLbl = '//div[@class="logo-text"]';
    private static $loginForm = "//form[@class='js-signin-form']";
    private static $welcomeLbl = "//ul/li//*[contains(@class,'user-email')]";


    /**
     * Define custom actions here
     */

    public function login($login, $password)
    {
        $I = $this;
        $I->seeElement(self::$loginLogoLbl);
        $I->submitForm(self::$loginForm, [
            'EMail' => $login,
            'Password' => $password
        ]);
        $I->see($login, self::$welcomeLbl);
    }

    public function downloadProductForOs($downloadsArea, $osBtn, $productDownloadBtn, $maxWait)
    {
        $I = $this;
        $I->seeElement($downloadsArea);
        $I->click($osBtn);
        $I->waitForElementVisible($productDownloadBtn, $maxWait);
        $I->click($productDownloadBtn);
    }

}
