<?php

namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class DetailsTest extends TestCase
{
   
    public static function detailsDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Details'))->getData();
    }

    public function testAddDetails()
    {
        try {
            $data = $this->detailsDataProvider();
            $emails = $data[0];
            $email = $emails[0];
            $account = new Account($email);
            $details = new Details();
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

            $data = ['id' => $account->id];

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testAddDetails')]
    public function testExpireCredentials(array $data)
    {
        try {
            $accountCredentialsExpired = (new Details())->expireCredentials($data['id']);

            $this->assertSame($accountCredentialsExpired, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testExpireCredentials')]
    public function testUnexpireCredentials(array $data)
    {
        try {
            $accountCredentialsUnexpired = (new Details())->unexpireCredentials($data['id']);

            $this->assertSame($accountCredentialsUnexpired, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUnexpireCredentials')]
    public function testLockAccount(array $data)
    {
        try {
            $accountLocked = (new Details())->lockAccount($data['id']);

            $this->assertSame($accountLocked, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testLockAccount')]
    public function testUnlockAccount(array $data)
    {
        try {
            $accountUnlocked = (new Details())->unlockAccount($data['id']);

            $this->assertSame($accountUnlocked, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUnlockAccount')]
    public function testDisableAccount(array $data)
    {
        try {
            $accountDisabled = (new Details())->disableAccount($data['id']);

            $this->assertSame($accountDisabled, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testDisableAccount')]
    public function testEnableAccount(array $data)
    {
        try {
            $accountEnabled = (new Details())->enableAccount($data['id']);

            $this->assertSame($accountEnabled, true);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testEnableAccount')]
    public function testUnexpireAccount(array $data)
    {
        try {
            $accountUnexpired = (new Details())->unexpireAccount($data['id']);

            $this->assertTrue($accountUnexpired, true);
            
            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUnexpireAccount')]
    public function testExpireAccount(array $data)
    {
        try {
            $accountExpired = (new Details())->expireAccount($data['id']);

            $this->assertSame($accountExpired, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
