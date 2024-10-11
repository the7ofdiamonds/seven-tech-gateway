<?php

namespace SEVEN_TECH\Gateway\Test\Session;

use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\TestCase;

use SEVEN_TECH\Gateway\Session\SessionWordpress;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Test\Spreadsheet;
use SEVEN_TECH\Gateway\Test\DataProviders;

class SessionWordpressTest extends TestCase
{

    public function testGet()
    {
        try {
            $data = [];

            $user_id = 99;

            $sessions = (new SessionWordpress())->get($user_id);

            $this->assertIsArray($sessions);

            $data['user_id'] = $user_id;

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while getting session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testGet')]
    public function testCreate(array $data)
    {
        try {
            $session = new Session();
            $session->expiration = 123456;
            $session->ip = "123.456.7890";
            $session->user_agent = "user agent";
            $session->login = "login";
            $session->user_id = $data['user_id'];

            $createdSession = (new SessionWordpress())->create($session);

            $this->assertIsInt($createdSession);

            $data['verifier'] = $session->id;

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while creating session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testCreate')]
    public function testFind(array $data) {
        try{
            $foundSession = (new SessionWordpress())->find($data['user_id'], $data['verifier']);

            $this->assertIsArray($foundSession);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while finding session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testFind')]
    public function testUpdate(array $data) {
        try{
            $key = 'expiration';
            $value = 1234567;
            $sessionUpdate = (new SessionWordpress())->update($data['user_id'], $data['verifier'], $key, $value);
            
            $this->assertTrue($sessionUpdate);

            return $data;
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while updating session: " . $e->getErrorMessage());
        }
    }

    #[Depends('testUpdate')]
    public function testDelete(array $data) {
        try{
            $sessionDeleted = (new SessionWordpress())->delete($data['user_id'], $data['verifier']);

            $this->assertTrue($sessionDeleted);
        } catch (DestructuredException $e) {
            $this->fail("Exception thrown while deleting session: " . $e->getErrorMessage());
        }
    }
}
