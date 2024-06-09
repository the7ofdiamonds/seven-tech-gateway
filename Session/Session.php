<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Session
{
    public $id;
    public $username;
    public $authorities;
    public $algorithm;
    public $access_token;
    public $refresh_token;
    public $hashed_token;
    public $ip;
    public $user_agent;
    public $login;
    public $remember;
    public $secure;
    public $expiration;
    public $expire;
    public $auth_cookie_name;
    public $scheme;

    public function __construct(Authenticated $authenticated = null, $ip = '', $user_agent = '', $remember = false, $secure = '')
    {
        $this->id = $authenticated->id;
        $this->username = $authenticated->username;
        $this->authorities = $authenticated->roles;
        $this->algorithm = $authenticated->algorithm;
        $this->access_token = $authenticated->access_token;
        $this->refresh_token = $authenticated->refresh_token;
        $this->hashed_token = (new Token)->hashToken($authenticated->refresh_token);
        $this->ip = $ip;
        $this->user_agent = $user_agent;
        $this->login = time();
        $this->remember = $remember;
        $this->secure = $secure;

        if ($remember) {
            $this->expiration = time() + apply_filters('auth_cookie_expiration', 14 * DAY_IN_SECONDS, $this->id, $remember);
            $this->expire = $this->expiration + (12 * HOUR_IN_SECONDS);
        } else {
            $this->expiration = time() + apply_filters('auth_cookie_expiration', 2 * DAY_IN_SECONDS, $this->id, $remember);
            $this->expire     = 0;
        }

        if ('' === $secure) {
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

    function findSession($session_verifier, $id = '')
    {
        if (empty($session_verifier)) {
            throw new Exception('Session Verifier is required to find session.', 404);
        }

        $session = false;

        if ($id != '') {
            $session = (new SessionWordpress)->findSession($id, $session_verifier);
        }

        return $session;
    }
}
