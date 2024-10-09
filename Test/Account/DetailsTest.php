<?php

namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class DetailsTest extends TestCase
{
    private String $email = "";

    /**
     * Data provider for DetailsTest
     */
    public static function detailsDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Details'))->getData();
    }

    /** 
     * @test
     * @dataProvider detailsDataProvider
     *  */
    public function testAddDetails($email)
    {
        try {
            $this->email = $email;

            $account = new Account($email);
            $details = new Details($account->email);
            $isEnabledAdded = $details->addDetails($account->id, 'is_enabled', 1);
            $isAuthenticatedAdded = $details->addDetails($account->id, 'is_authenticated', 1);
            $isAccountNonExpiredAdded = $details->addDetails($account->id, 'is_account_non_expired', 0);
            $isAccountNonLockedAdded = $details->addDetails($account->id, 'is_account_non_locked', 1);
            $isCredentialsNonExpiredAdded = $details->addDetails($account->id, 'is_credentials_non_expired', 1);

            $this->assertSame($isEnabledAdded, true);
            $this->assertSame($isAuthenticatedAdded, true);
            $this->assertSame($isAccountNonExpiredAdded, true);
            $this->assertSame($isAccountNonLockedAdded, true);
            $this->assertSame($isCredentialsNonExpiredAdded, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testExpireCredentials()
    {
        try {
            $details = new Details($this->email);
            $accountCredentialsExpired = $details->expireCredentials();

            $this->assertSame($accountCredentialsExpired, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnexpireCredentials()
    {
        try {
            $details = new Details($this->email);
            $accountCredentialsUnexpired = $details->unexpireCredentials();

            $this->assertSame($accountCredentialsUnexpired, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testLockAccount()
    {
        try {
            $details = new Details($this->email);
            $accountLocked = $details->lockAccount();

            $this->assertSame($accountLocked, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnlockAccount()
    {
        try {
            $details = new Details($this->email);
            $accountUnlocked = $details->unlockAccount();

            $this->assertSame($accountUnlocked, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testDisableAccount()
    {
        try {
            $details = new Details($this->email);
            $accountDisabled = $details->disableAccount();

            $this->assertSame($accountDisabled, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testEnableAccount()
    {
        try {
            $details = new Details($this->email);
            $accountEnabled = $details->enableAccount();

            $this->assertSame($accountEnabled, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testExpireAccount()
    {
        try {
            $details = new Details($this->email);
            $accountExpired = $details->expireAccount();

            $this->assertSame($accountExpired, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUnexpireAccount()
    {
        try {
            $details = new Details($this->email);
            $accountUnexpired = $details->unexpireAccount();

            $this->assertTrue($accountUnexpired, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
