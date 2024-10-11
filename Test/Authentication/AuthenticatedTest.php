<?php

namespace SEVEN_TECH\Gateway\Test\Authentication;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class AuthenticatedTest extends TestCase {

    public static function authDataProvider()
    {
        $data = [];

        // return (new Spreadsheet((new DataProviders)->accountPath, 'Details'))->getData();

        $data['accessToken'] = "eyJhbGciOiJIUzI1NiJ9.eyJsb2NhdGlvbiI6eyJsb25naXR1ZGUiOjEyMzQ1NjcuMCwibGF0aXR1ZGUiOjEyMzQ1NjcuMH0sImlzcyI6Im9yYi1nYXRld2F5Iiwic3ViIjoidGVzdHVzZXI0MCIsImlhdCI6MTcyODEzOTEwOCwiZXhwIjoxNzI4MjI1NTA4fQ.kt1DuorfxPcDkn8lTxZORsLmzdFJ5o9Cg8_Ik-x-kE0";
        $data['refreshToken'] = "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJvcmItZ2F0ZXdheSIsInN1YiI6InRlc3R1c2VyNDAiLCJpYXQiOjE3MjgxMzkxMDgsImV4cCI6MTcyODIyNTUwOH0.Ys5Y423lOPoJzcgOVVR0lX8obtt7K7J_jAX4qucy-LY";

        return $data;
    }

    public function testConstructor()
    {
        try {
            $data = $this->authDataProvider();
            $authenticated = new Authenticated($data['accessToken'], $data['refreshToken']);

            $this->assertNotNull($authenticated->id);
            $this->assertNotNull($authenticated->username);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown during activation: " . $e->getErrorMessage());
        }
    }
}