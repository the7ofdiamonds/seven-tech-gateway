<?php
namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AccountTest extends TestCase
{
    private String $email = "testuser40@gmail.com";

    /**
     * Data provider for testCreateAccount
     */
    public Static function accountDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Account'))->getData();
    }

    /**
     * Data provider for testAddDetails
     */
    public Static function addDetailsDataProvider()
    {
        return [
            ['is_enabled', 1],
            ['is_authenticated', 1],
            ['is_account_non_expired', 0],
            ['is_account_non_locked', 1],
            ['is_credentials_non_expired', 1]
        ];
    }

    /** 
     * @test
     * @dataProvider accountDataProvider
     *  */
    public function testActivate(String $email)
    {
        try {
            $account = new Account($email);

            $accountActivated = $account->activate($account->userActivationKey);

            $this->assertSame($accountActivated, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** 
     * @test
     * @dataProvider addDetailsDataProvider
     *  */
    public function testAddDetails($metaKey, $metaValue)
    {
         try {
             $account = new Account($this->email);
 
             $detailsAdded = $account->addDetails($metaKey, $metaValue);
 
             $this->assertSame($detailsAdded, true);
         } catch (DestructuredException $e) {
             $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
         }
     }

    /** @test */
    public function testLock()
    {
        try {
            $account = new Account($this->email);

            $lockResult = $account->lock($account->confirmationCode);

            $this->assertTrue($lockResult, "Account should be locked.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnlock()
    {
        try {
            $account = new Account($this->email);

            $unlockResult = $account->unlock($account->confirmationCode);

            $this->assertTrue($unlockResult, "Account should be unlocked.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testDisable()
    {
        try {
            $account = new Account($this->email);

            $disableResult = $account->disable($account->confirmationCode);

            $this->assertTrue($disableResult, "Account should be disabled.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testEnable()
    {
        try {
            $account = new Account($this->email);

            $enableResult = $account->enable($account->confirmationCode);

            $this->assertTrue($enableResult, "Account should be enabled.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
