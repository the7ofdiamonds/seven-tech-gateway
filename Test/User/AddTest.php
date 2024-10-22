<?php

namespace SEVEN_TECH\Gateway\Test\User;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\User\Add;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AddTest extends TestCase
{

    public Static function addDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Create'))->getData();
    }

    #[DataProvider('addDataProvider')]
    public function testAddUser($email, $username, $password, $confirmPassword, $nicename, $phone)
    {
        try {
            $add = new Add();

            $userAdded = $add->user($email, $username, $password, $confirmPassword, $nicename, $phone);

            error_log($userAdded->id);
            error_log($userAdded->providergivenID);

            $this->assertNotNull($userAdded->id);
            $this->assertNotNull($userAdded->providergivenID);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while adding a new user: " . $e->getErrorMessage());
        }
    }
}