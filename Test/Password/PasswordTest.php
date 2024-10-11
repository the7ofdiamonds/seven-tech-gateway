<?php

namespace SEVEN_TECH\Gateway\Test\Password;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class PasswordTest extends TestCase
{

    public static function passwordTestDataProvider()
    {
        $data = [];
        $provider = (new Spreadsheet((new DataProviders)->passwordPath, 'Password'))->getData()[0];
        $data['email'] = $provider[0];
        $data['password'] = $provider[1];
        $data['newPassword'] = $provider[2];
        $data['confirmPassword'] = $provider[3];
        $data['confirmationCode'] = $provider[4];
        $data['updatePassword'] = $provider[5];
        $data['updateConfirmPassword'] = $provider[6];

        return $data;
    }

    public function testChange() {
        try {
            $data = $this->passwordTestDataProvider();

            $changed = (new Password())->change(
                $data['email'],
                $data['password'],
                $data['newPassword'],
                $data['confirmPassword']
            );
            
            $this->assertTrue($changed);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testChange')]
    public function testUpdate(array $data)
    {
        try {
            $updated = (new Password())->update(
                $data['email'],
                $data['confirmationCode'],
                $data['updatePassword'],
                $data['updateConfirmPassword']
            );

            $this->assertTrue($updated);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
