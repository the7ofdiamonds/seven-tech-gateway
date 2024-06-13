<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Services\Redis\RedisSession;

class SessionRedis
{

    function findSessions()
    {
    }

    function createSession(Session $session)
    {
        $sessionArray = array(
            'id' => $session->id,
            'algorithm' => $session->algorithm,
            'expiration' => $session->expiration,
            'ip' => $session->ip,
            'user_agent' => $session->user_agent,
            'login' => $session->login,
            'access_token' => $session->access_token,
            'refresh_token' => $session->refresh_token,
            'username' => $session->username,
            'authorities' => $session->authorities
        );

        $savedSession = (new RedisSession)->connection->set($session->token, '.', ['foo2'=>'bar2']);

        return $savedSession;
    }

    function findSession($session_id)
    {
        $session = (new RedisSession)->connection->get($session_id);

        if (empty($session)) {
            $session = 0;
        }

        return $session;
    }

    function updateSession($session_id, $expiration, $accessToken)
    {
        $updatedSession = array(
            'expiration' => $expiration,
            'access_token' => $accessToken,
        );

        return (new RedisSession)->connection->set($session_id, '.', $updatedSession);
    }

    function deleteSession($session_id)
    {
        return (new RedisSession)->connection->del($session_id);
    }
}
