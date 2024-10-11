<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Authentication\Logout;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class LogoutTest extends TestCase
{

    public static function logoutDataProvider()
    {
        $data = [];

        // return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();
        $data['id'] = 99;
        $data['accessToken'] = "";
        $data['refreshToken'] = "";

        return $data;
    }

    public function testSession()
    {
        try {
            $data = $this->logoutDataProvider();
            $auth = new Authenticated($data['accessToken'], $data['refreshToken']);
$session = new Session($auth);
            $loggedOut = (new Logout())->session($session);

            $this->assertTrue($loggedOut);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testSession')]
    public function testAll(array $data)
    {
        try {
            $loggedOut = (new Logout())->all($data['id']);

            $this->assertTrue($loggedOut);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}