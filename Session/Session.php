<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Session
{
    public $id;
    public $username;
    public $passwordFrag;
    public $authorities;
    public $algorithm;
    public $access_token;
    public $refresh_token;
    public $token;
    public $ip;
    public $user_agent;
    public $login;
    public $secure;
    public $expiration;
    public $expire;
    public $auth_cookie_name;
    public $scheme;

    public function __construct(Authenticated $authenticated = null, $ip = '', $user_agent = '', $secure = '')
    {
        if ($authenticated != null && $ip != '' && $user_agent != '') {
            $this->id = $authenticated->id;
            $this->username = $authenticated->username;
            $this->passwordFrag = $authenticated->passwordFrag;
            $this->authorities = $authenticated->roles;
            $this->algorithm = $authenticated->algorithm;
            $this->access_token = $authenticated->access_token;
            $this->refresh_token = $authenticated->refresh_token;
            $this->token = substr((new Token)->hashToken($authenticated->refresh_token), 0, 43);
            $this->ip = $ip;
            $this->user_agent = $user_agent;
            $this->login = time();
            $this->secure = $secure;
            $this->expiration = time() + apply_filters('auth_cookie_expiration', get_option('session_length', DAY_IN_SECONDS), $this->id, true);
            $this->expire = $this->expiration;

            if ($secure === '') {
                $this->secure = is_ssl();
            }

            if ($secure) {
                $this->auth_cookie_name = SECURE_AUTH_COOKIE;
                $this->scheme           = 'secure_auth';
            } else {
                $this->auth_cookie_name = AUTH_COOKIE;
                $this->scheme           = 'auth';
            }
        }
    }

    function createSession(Session $session)
    {
        $redisSessionDB = new RedisSession;

        if ($redisSessionDB->isReady) {
            (new SessionRedis)->createSession($session);
        } else {
            (new SessionWordpress)->createSession($session);
        }
    }

    function findSession($session_verifier, $id = '')
    {
        try {
            if (empty($session_verifier)) {
                throw new Exception('Session Verifier is required to find session.', 404);
            }

            $session = (new SessionWordpress)->findSession($id, $session_verifier);

            if (!$session && (new RedisSession)->isReady) {
                $session = (new SessionRedis)->findSession($session_verifier);
            }

            return $session;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function getSessions($email)
    {
        try {
            $account = new Account($email);

            $sessions = [];

            $sessionsWordpress = (new SessionWordpress)->getSessions($account->id);

            if (is_array($sessionsWordpress)) {
                $sessions = $sessionsWordpress;
            }

            $redisSessionDB = new RedisSession;

            if ($redisSessionDB->isReady) {
                $sessionsRedis = (new SessionRedis)->getSessions($account->id);

                if (is_array($sessionsRedis)) {
                    $sessions = array_merge($sessions, $sessionsRedis);
                }
            }

            $accountSessions = array('id' => $account->id, 'provider_given_id' => $account->provider_given_id, 'sessions' => $sessions);

            return $accountSessions;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateSession($session_verifier, $expiration, $accessToken)
    {
        try {
            $updatedSession = (new SessionRedis)->updateSession($session_verifier, $expiration, $accessToken);
// Update session with new access token
            return $updatedSession;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function deleteSession($id, $verifier)
    {
        try {
            $sessionWordpress = (new SessionWordpress)->findSession($id, $verifier);

            if (is_array($sessionWordpress)) {
                $sessionDeleted = (new SessionWordpress)->deleteSession($id, $verifier);

                return $sessionDeleted;
            }

            $sessionRedis = (new SessionRedis)->findSession($verifier);

            if (is_array($sessionRedis)) {
                $sessionDeleted = (new SessionRedis)->deleteSession($verifier);

                return $sessionDeleted;
            }
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
