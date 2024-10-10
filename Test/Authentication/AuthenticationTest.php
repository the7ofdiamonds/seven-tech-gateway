<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AuthenticationTest extends TestCase
{

    public static function authDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();
    }

    public function testAddProviderGivenID()
    {
        $email = "testuser40@gmail.com";
        $provider_given_id= "ABC123def456";
        $data = ['email' => $email];

        try {
            $providerGivenIDAdded = (new Authentication($email))->addProviderGivenID($provider_given_id);

            $this->assertTrue($providerGivenIDAdded, "ID given by provider should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return $data;
    }

    #[Depends('testAddProviderGivenID')]
    public function testAddActivationKey(array $data)
    {
        try {
            $activationKey = (new Authentication($data['email']))->addActivationKey();

            $this->assertNotNull($activationKey);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return $data;
    }
    
    #[Depends('testAddActivationKey')]
    public function testUpdateActivationKey(array $data)
    {
        try {
            $activationKey = (new Authentication($data['email']))->updateActivationKey();

            $this->assertNotNull($activationKey);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return $data;
    }

    #[Depends('testUpdateActivationKey')]
    public function testAddConfirmationCode(array $data)
    {
        try {
            $auth = new Authentication($data['email']);
            $confirmationCode = $auth->addConfirmationCode();
            $data['confirmationCode'] = $confirmationCode;

            $this->assertNotNull($confirmationCode);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return $data;
    }

    #[Depends('testAddConfirmationCode')]
    public function testUpdateConfirmationCode(array $data)
    {
        try {
            $auth = new Authentication($data['email']);

            $confirmationCode = $auth->updateConfirmationCode();

            $this->assertNotNull($confirmationCode);

            $data['confirmationCode'] = $confirmationCode;

        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return $data;    
    }

    #[Depends('testUpdateConfirmationCode')]
    public function testVerifyCredentials(array $data) {
        try {
            error_log($data['confirmationCode']);
            $credentialsVerified = (new Authentication($data['email']))->verifyCredentials($data['confirmationCode']);

            $this->assertTrue($credentialsVerified, "Credentials should be verified.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
