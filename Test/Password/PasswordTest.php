<?php

namespace SEVEN_TECH\Gateway\Test\Password;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class PasswordTest extends TestCase
{
    private String $email = "";
    private String $confirmationCode = "";
    private String $updatePassword = "";
    private String $updateConfirmPassword = "";

    /**
     * Data provider for PasswordTest
     */
    public static function passwordTestDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->passwordPath, 'Password'))->getData();
    }

    /** 
     * @test
     * @dataProvider passwordTestDataProvider
     */
    public function testChange(
        $email,
        $password,
        $newPassword,
        $confirmPassword,
        $confirmationCode,
        $updatePassword,
        $updateConfirmPassword
    ) {
        try {
            $this->email = $email;
            $this->confirmationCode = $confirmationCode;
            $this->updatePassword = $updatePassword;
            $this->updateConfirmPassword = $updateConfirmPassword;

            $changed = (new Password())->change(
                $email,
                $password,
                $newPassword,
                $confirmPassword
            );
            
            $this->assertTrue($changed, "Password should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testUpdate()
    {
        try {
            $updated = (new Password())->update(
                $this->email,
                $this->confirmationCode,
                $this->updatePassword,
                $this->updateConfirmPassword
            );

            $this->assertTrue($updated, "Email should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
