<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class SessionRedis
{

    function getSessions($user_id)
    {
        try {
            $session = (new RedisSession)->connection->get($user_id, '$');

            $keys = (new RedisSession)->connection->keys("*");

            $sessions = [];

            foreach ($keys as $key) {
                $session = (new RedisSession)->connection->get($key, '$');

                if (isset($session['user_id']) && $session['user_id'] == $user_id) {
                    $sessions[$key] = $session;
                }
            }

            if (empty($sessions)) {
                $sessions = 0;
            }

            return $sessions;
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function createSession(string $verifier, Session $session)
    {
        try {
            $savedSession = (new RedisSession)->connection->set("sessions:{$verifier}", '$', $session);

            if ($savedSession !== 'OK') {
                throw new Exception('There was an error saving your session to redis database.', 500);
            }

            return $savedSession;
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function findSession($session_id)
    {
        try {
            if (empty($session_id)) {
                throw new Exception('Session verifier is required to find the session.', 400);
            }

            $session = (new RedisSession)->connection->get($session_id);

            if (empty($session)) {
                $session = 0;
            }

            return $session;
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function updateSession($session_id, $expiration, $accessToken)
    {
        try {
            $updatedSession = array(
                'expiration' => $expiration,
                'access_token' => $accessToken,
            );

            return (new RedisSession)->connection->set($session_id, '.', $updatedSession);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function deleteSession($session_id)
    {
        try {
            return (new RedisSession)->connection->del($session_id);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
