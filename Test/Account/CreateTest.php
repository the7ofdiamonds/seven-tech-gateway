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
     * Data provider for CreateTest
     */
    public Static function createDataProvider()
    {
        return (new Spreadsheet((new DataProviders)->accountPath, 'Create'))->getData();
    }

    /** 
     * @test
     * @dataProvider createDataProvider
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
