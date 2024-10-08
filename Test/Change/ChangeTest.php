<?php

namespace SEVEN_TECH\Gateway\Test\Change;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Change\Change;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class ChangeTest extends TestCase
{
    /** @test */
    public function testUsername($email, $username)
    {
        try {
            $usernameChanged = (new Change($email))->username($username);

            $this->assertTrue($usernameChanged, "Username should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testNicename($email, $nicename)
    {
        try {
            $nicenameChanged = (new Change($email))->nicename($nicename);

            $this->assertTrue($nicenameChanged, "Nicename should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testNickname($email, $nickname)
    {
        try {
            $nicknameChanged = (new Change($email))->nickname($nickname);

            $this->assertTrue($nicknameChanged, "Nickname should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testFirstName($email, $firstname)
    {
        try {
            $firstNameChanged = (new Change($email))->firstName($firstname);

            $this->assertTrue($firstNameChanged, "First name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testLastName($email, $lastname)
    {
        try {
            $lastNameChanged = (new Change($email))->lastName($lastname);

            $this->assertTrue($lastNameChanged, "Last name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testName($email, $firstName, $lastName)
    {
        try {
            $nameChanged = (new Change($email))->name($firstName, $lastName);

            $this->assertTrue($nameChanged, "Name should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    /** @test */
    public function testPhone($email, $phone)
    {
        try {
            $phoneNumberChanged = (new Change($email))->phone($phone);

            $this->assertTrue($phoneNumberChanged, "Phone number should be changed.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
