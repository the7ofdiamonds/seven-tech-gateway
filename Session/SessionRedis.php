<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class SessionRedis
{

    function get(int $user_id)
    {
        try {
            $session = (new RedisSession)->connection->get((string) $user_id, '$');

            $keys = (new RedisSession)->connection->keys("*");

            $sessions = [];

            foreach ($keys as $key) {
                $session = (new RedisSession)->connection->get($key, '$');

                if (isset($session['user_id']) && $session['user_id'] == $user_id) {
                    $sessions[$key] = $session;
                }
            }

            if (empty($sessions)) {
                $sessions = [];
            }

            return $sessions;
        } catch (Exception $e) {
            return new DestructuredException($e);
        }
    }

    function create(Session $session)
    {
        try {
            $savedSession = (new RedisSession)->connection->set("sessions:{$session->id}", '$', $session);

            if ($savedSession !== 'OK') {
                throw new Exception('There was an error saving your session to redis database.', 500);
            }

            return true;
        } catch (Exception $e) {
            return new DestructuredException($e);
        }
    }

    function find(string $session_id)
    {
        try {
            if (empty($session_id)) {
                throw new Exception('Session verifier is required to find the session.', 400);
            }

            $session = (new RedisSession)->connection->get($session_id);

            if (empty($session)) {
                $session = [];
            }

            return $session;
        } catch (Exception $e) {
            return new DestructuredException($e);
        }
    }

    function update(Session $session)
    {
        try {
            $updatedSession = array(
                'expiration' => $session->expiration,
                'access_token' => $session->access_token,
            );

            $sessionUpdated = (new RedisSession)->connection->set($session->id, '.', $updatedSession);

            if ($sessionUpdated !== 'OK') {
                throw new Exception('There was an error updating your session.', 500);
            }

            return true;
        } catch (Exception $e) {
            return new DestructuredException($e);
        }
    }

    function delete(string $session_id)
    {
        try {
            $sessionDeleted = (new RedisSession)->connection->del($session_id);

            if (!is_int($sessionDeleted)) {
                throw new Exception('There was an error removing your session.', 500);
            }

            return true;
        } catch (Exception $e) {
            return new DestructuredException($e);
        }
    }
}
