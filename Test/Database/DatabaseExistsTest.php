<?php

namespace SEVEN_TECH\Gateway\Test\Database;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class DatabaseExistsTest extends TestCase
{

    public static function databaseExistsTestDataProvider()
    {
        $data = [];
        $provider = (new Spreadsheet((new DataProviders)->databasePath, 'Exists'))->getData()[0];
        $data['email'] = $provider[0];
        $data['username'] = $provider[1];
        $data['nicename'] = $provider[2];
        $data['phone'] = $provider[3];

        return $data;
    }

    function testExistsByEmail()
    {
        try {
            $data = $this->databaseExistsTestDataProvider();
            $emailExists = (new DatabaseExists)->existsByEmail($data['email']);

            $this->assertTrue($emailExists);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while testing email exists: " . $e->getErrorMessage());
        }
    }

    function testExistsByUsername()
    {
        try {
            $data = $this->databaseExistsTestDataProvider();
            $usernameExists = (new DatabaseExists)->existsByUsername($data['username']);

            $this->assertTrue($usernameExists);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while testing username exists: " . $e->getErrorMessage());
        }
    }

    function testExistsByNicename()
    {
        try {
            $data = $this->databaseExistsTestDataProvider();
            $nicenameExists = (new DatabaseExists)->existsByNicename($data['nicename']);

            $this->assertTrue($nicenameExists);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while testing nicename exists: " . $e->getErrorMessage());
        }
    }

    function testExistsByPhone()
    {
        try {
            $data = $this->databaseExistsTestDataProvider();
            $phoneExists = (new DatabaseExists)->existsByPhone($data['phone']);

            $this->assertTrue($phoneExists);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while testing phone exists: " . $e->getErrorMessage());
        }
    }
}
