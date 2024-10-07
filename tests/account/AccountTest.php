<?php

use PHPUnit\Framework\TestCase;
use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class AccountTest extends TestCase
{
    private String $email = "testuser40@gmail.com";
    private String $userActivationKey = "LvlGWjtoehgShEZnmWte";
    private String $confirmationCode = "963eEDKdO4H3yE2By3dd";

    /** @test */
    public function testActivate()
    {
        try {
            $account = new Account($this->email);

            $accountActivated = $account->activate($account->userActivationKey);

            $this->assertSame($accountActivated, true);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testVerify()
    {
        try {
            $account = new Account($this->email);

            $verificationResult = $account->verify($account->confirmationCode);

            $this->assertTrue($verificationResult, "Verification should return true.");
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

    /** @test */
    public function testUnexpire()
    {
        try {
            $account = new Account($this->email);

            $unexpireResult = $account->unexpire($account->userActivationKey);

            $this->assertTrue($unexpireResult, "Account should be unexpired.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
