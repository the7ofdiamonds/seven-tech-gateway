<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Services\Redis\RedisSession;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

class Session
{
    public string $access_token;
    public string $refresh_token;
    public string $id;
    public int $user_id;
    public string $email;
    public string $username;
    public $authorities;
    public $algorithm;
    public $ip;
    public $location;
    public $user_agent;
    public $login;

    public $expiration;
    public $expire;

    public $scheme;
    public $token;
    public $secure;
    public $admin_cookie_name;

    public function __construct(Authenticated $authenticated = null, $ip = '', $location = '', $user_agent = '')
    {
        if ($authenticated != null) {
            $this->access_token = $authenticated->access_token;
            $this->refresh_token = $authenticated->refresh_token;

            $this->token = $this->getToken($this->refresh_token);

            $this->id = $this->getID($this->token);

            $this->email = $authenticated->email;

            $this->username = $authenticated->username;

            $this->authorities = $authenticated->roles;
            $this->algorithm = $authenticated->algorithm;

            $this->ip = $ip;
            $this->location = $location;
            $this->user_agent = $user_agent;

            $this->login = $authenticated->auth_time;

            $this->user_id = $authenticated->id;

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

    function getToken(string $refresh_token) : string {
        return substr((new Token)->hashToken($refresh_token), 0, 43);
    }

    function getID(string $token) : string {
        return (new Token)->hashToken($token);
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

    function find(string $verifier, int $user_id = null)
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

    function get(string $email)
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

            if (is_array($sessions) && !empty($sessions)) {
                (new Details())->isNotAuthenticated($account->id);
            }

            $accountSessions = array('id' => $account->id, 'provider_given_id' => $account->providerGivenID, 'sessions' => $sessions);

            return $accountSessions;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function update(Session $session)
    {
        try {
            $updatedSession = false;

            if ((new RedisSession)->isReady) {
                $updatedSession = (new SessionRedis)->update($session);
            } else {
                $updatedSession = (new SessionWordpress)->update($session);
            }

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
            $sessionDeleted = false;

            if ((new RedisSession)->isReady) {
                $sessionDeleted = (new SessionRedis)->delete($session->id);
            } else {
                $sessionDeleted = (new SessionWordpress)->delete($session);
            }

            return $sessionDeleted;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
