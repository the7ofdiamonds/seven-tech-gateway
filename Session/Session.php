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
    public $user_id;
    public $email;
    public $username;
    public $passwordFrag;
    public $authorities;
    public $algorithm;
    public $access_token;
    public $refresh_token;
    public $token;
    public $ip;
    public $location;
    public $user_agent;
    public $login;
    public $secure;
    public $expiration;
    public $expire;
    public $admin_cookie_name;
    public $scheme;

    public function __construct(Authenticated $authenticated = null, $ip = '', $location = '', $user_agent = '')
    {
        if ($authenticated != null && $ip != '' && $user_agent != '') {
            $this->user_id = $authenticated->id;
            $this->email = $authenticated->email;
            $this->username = $authenticated->username;
            $this->passwordFrag = $authenticated->passwordFrag;
            $this->authorities = $authenticated->roles;
            $this->algorithm = $authenticated->algorithm;
            $this->access_token = $authenticated->access_token;
            $this->refresh_token = $authenticated->refresh_token;
            $this->token = $authenticated->token;
            $this->id = $authenticated->verifier;
            $this->ip = $ip;
            $this->location = $location;
            $this->user_agent = $user_agent;
            $this->login = $authenticated->auth_time;
            $this->secure = is_ssl();
            $this->expiration = $authenticated->expiration;
            $this->expire = $this->expiration;

            if ($this->secure) {
                $this->admin_cookie_name = SECURE_AUTH_COOKIE;
                $this->scheme           = 'secure_auth';
            } else {
                $this->admin_cookie_name = AUTH_COOKIE;
                $this->scheme           = 'auth';
            }
        }
    }

    function create()
    {
        try {
            $sessionCreated = false;

            if ((new RedisSession)->isReady) {
                $sessionCreated = (new SessionRedis)->create($this);
            } else {
                $sessionCreated = (new SessionWordpress)->create($this);
            }

            return $sessionCreated;
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function find($verifier, $user_id = '')
    {
        try {
            
            if (empty($verifier)) {
                throw new Exception('Session Verifier is required to find session.', 404);
            }

            $session = (new SessionWordpress)->find($user_id, $verifier);

            if (!$session && (new RedisSession)->isReady) {
                if (strpos($verifier, 'sessions:') !== 0) {
                    $session_verifier = "sessions:{$verifier}";
                }

                $session = (new SessionRedis)->find($session_verifier);
            }

            return $session;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function get($email)
    {
        try {
            $account = new Account($email);

            $sessions = [];

            $sessionsWordpress = (new SessionWordpress)->get($account->id);

            if (is_array($sessionsWordpress)) {
                $sessions = $sessionsWordpress;
            }

            if ((new RedisSession)->isReady) {
                $sessionsRedis = (new SessionRedis)->get($account->id);

                if (is_array($sessionsRedis)) {
                    $sessions = array_merge($sessions, $sessionsRedis);
                }
            }

            $accountSessions = array('id' => $account->id, 'provider_given_id' => $account->providerGivenID, 'sessions' => $sessions);

            return $accountSessions;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function update($session_verifier, $expiration, $accessToken)
    {
        try {
            $updatedSession = (new SessionRedis)->update($session_verifier, $expiration, $accessToken);
            // Update session with new access token
            return $updatedSession;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function delete(Session $session)
    {
        try {
            if ((new RedisSession)->isReady) {
                $sessionRedis = (new SessionRedis)->find($session->id);

                if (is_array($sessionRedis)) {
                    $sessionDeleted = (new SessionRedis)->delete($session->id);

                    return $sessionDeleted;
                }
            }

            $sessionWordpress = (new SessionWordpress)->find($session->user_id, $session->id);

            if (is_array($sessionWordpress)) {
                $sessionDeleted = (new SessionWordpress)->delete($session);

                return $sessionDeleted;
            }
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
