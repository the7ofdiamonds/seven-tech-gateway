<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class LoginTest extends TestCase
{

    public static function loginDataProvider()
    {
        $data = [];

        // return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();

        $data['email'] = "testuser40@gmail.com";
        $data['password'] = "Test1234$";

        return $data;
    }

    public function testwithEmailAndPassword()
    {
        try {
            $data = $this->loginDataProvider();

            $authenticated = (new Login())->withEmailAndPassword($data['email'], $data['password']);

            $this->assertNotNull($authenticated->username);
            $this->assertNotNull($authenticated->access_token);
            $this->assertNotNull($authenticated->refresh_token);

            $data['accessToken'] = $authenticated->access_token;
            $data['refreshToken'] = $authenticated->refresh_token;

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }

    #[Depends('testwithEmailAndPassword')]
    public function testwithTokens(array $data)
    {
        try {
            $authenticated = (new Login())->withTokens($data['accessToken'], $data['refreshToken']);

            $this->assertNotNull($authenticated->username);
            $this->assertNotNull($authenticated->access_token);
            $this->assertNotNull($authenticated->refresh_token);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}