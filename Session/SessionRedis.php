<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Services\Redis\RedisSession;

class SessionRedis
{

    function findSessions()
    {
    }

    function createSession(string $ip, string $userAgent, Authenticated $authenticated, $hashedToken)
    {
        $sessionArray = array(
            'id' => $authenticated->id,
            'algorithm' => $authenticated->algorithm,
            'expiration' => time() + DAY_IN_SECONDS,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'login' => time(),
            'access_token' => $authenticated->access_token,
            'refresh_token' => $authenticated->refresh_token,
            'username' => $authenticated->username,
            'authorities' => $authenticated->roles
        );

        return (new RedisSession)->connection->hmset($hashedToken, $sessionArray);
    }

    function findSession($session_id)
    {
        return (new RedisSession)->connection->get($session_id);
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
        return (new RedisSession)->connection->delete($session_id);
    }
}
