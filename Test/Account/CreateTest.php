<?php
namespace SEVEN_TECH\Gateway\Test\Account;

use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Account\Create;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class CreateTest extends TestCase
{

    /**
     * Data provider for testCreateAccount
     */
    public Static function accountDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Account'))->getData();
    }

    /** 
     * @test
     * @dataProvider accountDataProvider
     *  */
    public function testCreateAccount($email, $username, $password, $confirmPassword, $nicename, $nickname, $firstname, $lastname, $phone)
    {
        try {
            $create = new Create();

            $accountCredentialsExpired = $create->account($email, $username, $password, $confirmPassword, $nicename, $nickname, $firstname, $lastname, $phone);

            $this->assertNotNull($accountCredentialsExpired['successMessage']);
            $this->assertEquals($accountCredentialsExpired['statusCode'], 200);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}
