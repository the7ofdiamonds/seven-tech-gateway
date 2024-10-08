<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AuthenticationTest extends TestCase
{
    private String $email;
    private String $provider_given_id;

    /**
     * Data provider for AuthenticationTest
     */
    public static function authDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();
    }

    /** 
     * @test
     * @dataProvider authDataProvider
     */
    public function testVerifyCredentials(
        $email,
        $confirmation_code,
        $provider_given_id
    ) {
        try {
            $this->email = $email;
            $this->provider_given_id = $provider_given_id;

            $credentialsVerified = (new Authentication($email))->verifyCredentials($confirmation_code);

            $this->assertTrue($credentialsVerified, "Credentials should be verified.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddProviderGivenID()
    {
        try {
            $providerGivenIDAdded = (new Authentication($this->email))->addProviderGivenID($this->provider_given_id);

            $this->assertTrue($providerGivenIDAdded, "ID given by provider should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddConfirmationCode()
    {
        try {
            $confirmationCodeAdded = (new Authentication($this->email))->addConfirmationCode();

            $this->assertTrue($confirmationCodeAdded, "Confirmation code should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
    /** @test */
    public function testUpdateConfirmationCode()
    {
        try {
            $confirmationCodeUpdated = (new Authentication($this->email))->updateConfirmationCode();

            $this->assertTrue($confirmationCodeUpdated, "Confirmation code should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testAddActivationKey()
    {
        try {
            $activationKeyAdded = (new Authentication($this->email))->addActivationKey();

            $this->assertTrue($activationKeyAdded, "User Activation Key should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUpdateActivationKey()
    {
        try {
            $activationKeyUpdated = (new Authentication($this->email))->updateActivationKey();

            $this->assertTrue($activationKeyUpdated, "User Activation Key should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
