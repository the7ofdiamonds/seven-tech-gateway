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
    public function testAddProviderGivenID($email, $provider_given_id) : array
    {
        try {
            $providerGivenIDAdded = (new Authentication($email))->addProviderGivenID($provider_given_id);

            $this->assertTrue($providerGivenIDAdded, "ID given by provider should be added.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return compact('email');
    }

    /** 
     * @test
     * @depends testAddProviderGivenID
     */
    public function testAddActivationKey(array $data) : array
    {
        try {
            $activationKey = (new Authentication($data['email']))->addActivationKey();

            error_log("User Activation Key: {$activationKey}");

            $this->assertNotNull($activationKey);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return compact(['email' => $data['email']]);
    }

    /** @test
     * @depends testAddActivationKey
     */
    public function testUpdateActivationKey(array $data) : array
    {
        try {
            $activationKey = (new Authentication($data['email']))->updateActivationKey();

            error_log("User Activation Key: {$activationKey}");

            $this->assertNotNull($activationKey);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return compact(['email' => $data['email']]);
    }

    /** @test
     * @depends testUpdateActivationKey
     */
    public function testAddConfirmationCode(array $data) : array
    {
        try {
            $confirmationCode = (new Authentication($data['email']))->addConfirmationCode();

            error_log("Confirmation Code: {$confirmationCode}");

            $this->assertNotNull($confirmationCode);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return compact(['email' => $data['email']]);
    }

    /** @test
     * @depends testAddConfirmationCode
     */
    public function testUpdateConfirmationCode(array $data) : array
    {
        try {
            $confirmationCode = (new Authentication($data['email']))->updateConfirmationCode();

            error_log("Confirmation Code: {$confirmationCode}");

            $this->assertNotNull($confirmationCode);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }

        return compact(['email' => $data['email'], 'confirmationCode' => $confirmationCode]);
    }

    /** @test
     * @depends testUpdateConfirmationCode
     */
    public function testVerifyCredentials(array $data) {
        try {
            $credentialsVerified = (new Authentication($data['email']))->verifyCredentials($data['confirmationCode']);

            $this->assertTrue($credentialsVerified, "Credentials should be verified.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
