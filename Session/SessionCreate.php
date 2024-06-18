<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Token\Token;

class SessionCreate
{
    public function __construct(Session $session)
    {
        $verifier = (new Token)->hashToken($session->token);

        if ((new RedisSession)->isReady) {
            (new SessionRedis)->createSession($verifier, $session);
        } else {
            (new SessionWordpress)->createSession($verifier, $session);
        }
    }
}
