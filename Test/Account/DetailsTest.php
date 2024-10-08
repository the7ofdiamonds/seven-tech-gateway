<?php
namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Account\Details;

class DetailsTest extends TestCase
{
    private String $email = "testuser40@gmail.com";

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
