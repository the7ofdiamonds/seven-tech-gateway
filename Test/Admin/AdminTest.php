<?php

namespace SEVEN_TECH\Gateway\Test\Admin;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Admin\Admin;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AdminTest extends TestCase
{

    public Static function deleteAccountDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->adminPath, 'Admin'))->getData();
    }

    #[DataProvider('deleteAccountDataProvider')]
    public function testDeleteAccount($email)
    {
        try {
            $accountDeleted = (new Admin())->deleteAccount($email);

            $this->assertTrue($accountDeleted, "Account should be deleted.");
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
