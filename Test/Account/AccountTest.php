<?php
namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AccountTest extends TestCase
{

    public Static function accountDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Account'))->getData();
    }

    #[DataProvider('accountDataProvider')]
    public function testConstructor($email)
    {
        try {
            $account = new Account($email);

            $this->assertSame($email, $account->email);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while testing account constructor: " . $e->getErrorMessage());
        }
    }

    #[DataProvider('accountDataProvider')]
    public function testActivate($email)
    {
        try {
            $account = new Account($email);
            $userActivationKey = $account->userActivationKey;
            $accountActivated = $account->activate($userActivationKey);

            $this->assertSame($accountActivated, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[DataProvider('accountDataProvider')]
    public function testLock($email)
    {
        try {
            $account = new Account($email);
            $lockResult = $account->lock($account->confirmationCode);

            $this->assertTrue($lockResult, "Account should be locked.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while locking account: " . $e->getErrorMessage());
        }
    }

    #[DataProvider('accountDataProvider')]
    public function testUnlock($email)
    {
        try {
            $account = new Account($email);
            $unlockResult = $account->unlock($account->userActivationKey);

            $this->assertTrue($unlockResult, "Account should be unlocked.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while unlocking account: " . $e->getErrorMessage());
        }
    }

    #[DataProvider('accountDataProvider')]
    public function testRecover($email)
    {
        try {
            $account = new Account($email);
            $recoverResult = $account->recover($account->userActivationKey);

            $this->assertTrue($recoverResult, "Account should be recovered.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during account recovery: " . $e->getErrorMessage());
        }
    }
}
