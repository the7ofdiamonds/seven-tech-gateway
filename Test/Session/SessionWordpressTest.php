<?php

namespace SEVEN_TECH\Gateway\Test\Session;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Session\SessionWordpress;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SessionWordpressTest extends TestCase
{

    public static function sessionDataProvider()
    {
        $data = [];

        // return (new Spreadsheet((new DataProviders)->authPath, 'Auth'))->getData();
        $data['email'] = "testuser40@gmail.com";
        $data['password'] = "Test1234$";
        $signedInUser = (new FirebaseAuth)->signInWithEmailAndPassword($data['email'], $data['password']);
        $data['user_id'] = 99;
        $data['ip'] = "123.456.7890";
        $data['user_agent'] = "user agent";
        $data['login'] = "login";
        $data['accessToken'] = $signedInUser->idToken();
        $data['refreshToken'] = $signedInUser->refreshToken();

        return $data;
    }

    public function testGet()
    {
        try {
            $data = $this->sessionDataProvider();

            $sessions = (new SessionWordpress())->get($data['user_id']);

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
            $auth = new Authenticated($data['accessToken'], $data['refreshToken']);
            $session = new Session($auth, $data['ip'], $data['location'], $data['user_agent']);

            $createdSession = (new SessionWordpress())->create($session);

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
            $foundSession = (new SessionWordpress())->find($data['user_id'], $data['verifier']);

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
            $signedInUser = (new FirebaseAuth)->signInWithEmailAndPassword($data['email'], $data['password']);
            $auth = new Authenticated($signedInUser->idToken(), $data['refreshToken']);
            $session = new Session($auth, $data['ip'], $data['location'], $data['user_agent']);
            $sessionUpdate = (new SessionWordpress())->update($session);

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
            $auth = new Authenticated($data['accessToken'], $data['refreshToken']);
            $session = new Session($auth, $data['ip'], $data['location'], $data['user_agent']);
            $sessionDeleted = (new SessionWordpress())->delete($session);

            $this->assertTrue($sessionDeleted);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while deleting session: " . $e->getErrorMessage());
        }
    }
}
