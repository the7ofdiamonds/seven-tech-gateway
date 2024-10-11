<?php

namespace SEVEN_TECH\Gateway\Test\Session;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionRedis;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SessionRedisTest extends TestCase
{

    public static function sessionDataProvider()
    {
        $data = [];

        // return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();
        $data['user_id'] = 99;
        $data['accessToken'] = "eyJhbGciOiJIUzI1NiJ9.eyJsb2NhdGlvbiI6eyJsb25naXR1ZGUiOjEyMzQ1NjcuMCwibGF0aXR1ZGUiOjEyMzQ1NjcuMH0sImlzcyI6Im9yYi1nYXRld2F5Iiwic3ViIjoidGVzdHVzZXI0MCIsImlhdCI6MTcyODEzOTEwOCwiZXhwIjoxNzI4MjI1NTA4fQ.kt1DuorfxPcDkn8lTxZORsLmzdFJ5o9Cg8_Ik-x-kE0";
        $data['refreshToken'] = "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJvcmItZ2F0ZXdheSIsInN1YiI6InRlc3R1c2VyNDAiLCJpYXQiOjE3MjgxMzkxMDgsImV4cCI6MTcyODIyNTUwOH0.Ys5Y423lOPoJzcgOVVR0lX8obtt7K7J_jAX4qucy-LY";
        $data['expiration'] = 123456;
        $data['ip'] = "123.456.7890";
        $data['user_agent'] = "user agent";
        $data['login'] = "login";

        return $data;
    }

    public function testGet()
    {
        try {
            $data = $this->sessionDataProvider();

            $sessions = (new SessionRedis())->get($data['user_id']);

            $this->assertIsArray($sessions);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while getting session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testGet')]
    public function testCreate(array $data)
    {
        try {
            $authenticated = new Authenticated($data['accessToken'], $data['refreshToken']);

            $session = new Session(
                $authenticated,
                $data['ip'],
                $data['location'],
                $data['user_agent']
            );

            $createdSession = (new SessionRedis())->create($session);

            $this->assertTrue($createdSession);

            $data['verifier'] = $session->id;

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while creating session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testCreate')]
    public function testFind(array $data)
    {
        try {
            $foundSession = (new SessionRedis())->find($data['verifier']);

            $this->assertIsArray($foundSession);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while finding session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testFind')]
    public function testUpdate(array $data)
    {
        try {
            $key = 'expiration';
            $value = 1234567;
            $sessionUpdate = (new SessionRedis())->update($data['user_id'], $data['verifier'], $key, $value);

            $this->assertTrue($sessionUpdate);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while updating session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUpdate')]
    public function testDelete(array $data)
    {
        try {
            $sessionDeleted = (new SessionRedis())->delete($data['user_id'], $data['verifier']);

            $this->assertTrue($sessionDeleted);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while deleting session: " . $e->getErrorMessage());
        }
    }
}
