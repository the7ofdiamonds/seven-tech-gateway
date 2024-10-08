<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AuthenticationTest extends TestCase
{

    /** @test */
    public function testVerifyCredentials($email, $confirmation_code)
    {
        try {
            $credentialsVerified = (new Authentication($email))->verifyCredentials($confirmation_code);

            $this->assertTrue($credentialsVerified, "Credentials should be verified.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddProviderGivenID($email, $provider_given_id)
    {
        try {
            $providerGivenIDAdded = (new Authentication($email))->addProviderGivenID($provider_given_id);

            $this->assertTrue($providerGivenIDAdded, "ID given by provider should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddConfirmationCode($email)
    {
        try {
            $confirmationCodeAdded = (new Authentication($email))->addConfirmationCode();

            $this->assertTrue($confirmationCodeAdded, "Confirmation code should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
    /** @test */
    public function testUpdateConfirmationCode($email)
    {
        try {
            $confirmationCodeUpdated = (new Authentication($email))->updateConfirmationCode();

            $this->assertTrue($confirmationCodeUpdated, "Confirmation code should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddActivationKey($email)
    {
        try {
            $activationKeyAdded = (new Authentication($email))->addActivationKey();

            $this->assertTrue($activationKeyAdded, "User Activation Key should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUpdateActivationKey($email)
    {
        try {
            $activationKeyUpdated = (new Authentication($email))->updateActivationKey();

            $this->assertTrue($activationKeyUpdated, "User Activation Key should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
