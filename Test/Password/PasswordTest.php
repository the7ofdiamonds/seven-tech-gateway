<?php

namespace SEVEN_TECH\Gateway\Test\Password;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class PasswordTest extends TestCase
{
    /** @test */
    public function testChange(
        $email,
        $password,
        $newPassword,
        $confirmPassword
    ) {
        try {
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
    public function testUpdate(
        $email,
        $confirmationCode,
        $password,
        $confirmPassword
    ) {
        try {
            $updated = (new Password())->update(
                $email,
                $confirmationCode,
                $password,
                $confirmPassword
            );

            $this->assertTrue($updated, "Email should be updated.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
