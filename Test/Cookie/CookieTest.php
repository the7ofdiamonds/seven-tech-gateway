<?php

namespace SEVEN_TECH\Gateway\Test\Cookie;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Cookie\Cookie;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class CookieTest extends TestCase
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

    // function testConstructor(array $data) {
    //     $cookie = new Cookie($data);

    //     $this->assertNotNull($cookie->username);
    //     $this->assertNotNull($cookie->hmac);
    //     $this->assertNotNull($cookie->token);
    //     $this->assertNotNull($cookie->expired);
    //     $this->assertNotNull($cookie->expiration);
    //     $this->assertNotNull($cookie->logged_in_cookie);
    // }
}