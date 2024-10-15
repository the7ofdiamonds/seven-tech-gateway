<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionRedis;
use SEVEN_TECH\Gateway\Session\SessionWordpress;

use Exception;

class Logout
{

    public function session(Authenticated $auth)
    {
        try {
            $session = new Session($auth);
            $session_destroyed = (new Session)->delete($session);

            if (!$session_destroyed) {
                throw new Exception('Unable to remove session.');
            }

            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('Account could not be logged out.', 400);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    public function all($id)
    {
        try {
            $wordpresSessions = (new SessionWordpress)->get($id);

            if (is_array($wordpresSessions) && !empty($wordpresSessions)) {
                $session_tokens_deleted = delete_user_meta($id, 'session_tokens');

                if (!$session_tokens_deleted) {
                    throw new Exception('There was an error deleting sessions.', 500);
                }
            }

            if ((new RedisSession)->isReady) {
                $redisSessions = (new SessionRedis)->get($id);

                if (is_array($redisSessions)) {
                    foreach ($redisSessions as $key => $value) {
                        (new SessionRedis)->delete($key);
                    }
                }
            }

            wp_logout();

            if (is_user_logged_in()) {
                throw new Exception('Account could not be logged out.', 400);
            }

            (new Details())->isNotAuthenticated($id);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
