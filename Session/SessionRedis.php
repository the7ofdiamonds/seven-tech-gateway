<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
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

        return (new RedisSession)->connection->hmset($session->hashed_token, $sessionArray);
    }

    function findSession($session_id)
    {
        return (new RedisSession)->connection->hgetall($session_id);
    }

    function updateSession($session_id, $accessToken)
    {
        $updatedSession = array(
            'expiration' => time() + DAY_IN_SECONDS,
            'access_token' => $accessToken,
        );

        return (new RedisSession)->connection->hmset($session_id, $updatedSession);
    }

    function deleteSession($session_id)
    {
        return (new RedisSession)->connection->del($session_id);
    }
}
