<?php

namespace SEVEN_TECH\Gateway\Test\Change;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Change\Change;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class ChangeTest extends TestCase
{

    public static function changeDataProvider()
    {
        $data = [];
        $provider = (new Spreadsheet((new DataProviders)->changePath, 'Change'))->getData()[0];
        $data['email'] = $provider[0];
        $data['username'] = $provider[1];
        $data['nicename'] = $provider[2];
        $data['nickname'] = $provider[3];
        $data['firstname'] = $provider[4];
        $data['lastname'] = $provider[5];
        $data['phone'] = $provider[6];

        return $data;
    }

    public function testUsername() {
        try {
            $data = $this->changeDataProvider();

            $usernameChanged = (new Change($data['email']))->username($data['username']);

            $this->assertTrue($usernameChanged);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUsername')]
    public function testNicename(array $data)
    {
        try {
            $nicenameChanged = (new Change($data['email']))->nicename($data['nicename']);

            $this->assertTrue($nicenameChanged, "Nicename should be changed.");

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testNicename')]
    public function testNickname(array $data)
    {
        try {
            $nicknameChanged = (new Change($data['email']))->nickname($data['nickname']);

            $this->assertTrue($nicknameChanged, "Nickname should be changed.");

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testNickname')]
    public function testFirstName(array $data)
    {
        try {
            $firstNameChanged = (new Change($data['email']))->firstName($data['firstname']);

            $this->assertTrue($firstNameChanged, "First name should be changed.");

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testFirstName')]
    public function testLastName(array $data)
    {
        try {
            $lastNameChanged = (new Change($data['email']))->lastName($data['lastname']);

            $this->assertTrue($lastNameChanged, "Last name should be changed.");

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testLastName')]
    public function testPhone(array $data)
    {
        try {
            $phoneNumberChanged = (new Change($data['email']))->phone($data['phone']);

            $this->assertTrue($phoneNumberChanged, "Phone number should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
