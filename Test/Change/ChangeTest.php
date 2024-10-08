<?php

namespace SEVEN_TECH\Gateway\Test\Change;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Change\Change;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class ChangeTest extends TestCase
{
        private String $email;
        private String $nicename;
        private String $nickname;
        private String $firstname;
        private String $lastname;
        private String $phone;

    /**
     * Data provider for ChangeTest
     */
    public static function changeDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->changePath, 'Change'))->getData();
    }

    /** 
     * @test
     * @dataProvider changeDataProvider
     */
    public function testUsername(
        $email,
        $username,
        $nicename,
        $nickname,
        $firstname,
        $lastname,
        $phone
    ) {
        try {
            $this->email = $email;
        $this->nicename = $nicename;
        $this->nickname = $nickname;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phone = $phone;

            $usernameChanged = (new Change($email))->username($username);

            $this->assertTrue($usernameChanged, "Username should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testNicename()
    {
        try {
            $nicenameChanged = (new Change($this->email))->nicename($this->nicename);

            $this->assertTrue($nicenameChanged, "Nicename should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testNickname()
    {
        try {
            $nicknameChanged = (new Change($this->email))->nickname($this->nickname);

            $this->assertTrue($nicknameChanged, "Nickname should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testFirstName()
    {
        try {
            $firstNameChanged = (new Change($this->email))->firstName($this->firstname);

            $this->assertTrue($firstNameChanged, "First name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testLastName()
    {
        try {
            $lastNameChanged = (new Change($this->email))->lastName($this->lastname);

            $this->assertTrue($lastNameChanged, "Last name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testName()
    {
        try {
            $nameChanged = (new Change($this->email))->name($this->firstname, $this->lastname);

            $this->assertTrue($nameChanged, "Name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testPhone()
    {
        try {
            $phoneNumberChanged = (new Change($this->email))->phone($this->phone);

            $this->assertTrue($phoneNumberChanged, "Phone number should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
