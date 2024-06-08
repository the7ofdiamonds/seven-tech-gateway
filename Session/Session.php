<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Session
{
    public function __construct()
    {
    }

    function set($id, $refresh_token, $remember = false, $secure = '')
    {
        try {
            if ($remember) {
                $expiration = time() + apply_filters('auth_cookie_expiration', 14 * DAY_IN_SECONDS, $id, $remember);
                $expire = $expiration + (12 * HOUR_IN_SECONDS);
            } else {
                $expiration = time() + apply_filters('auth_cookie_expiration', 2 * DAY_IN_SECONDS, $id, $remember);
                $expire     = 0;
            }

            if ('' === $secure) {
                $secure = is_ssl();
            }

            $secure_logged_in_cookie = $secure && 'https' === parse_url(get_option('home'), PHP_URL_SCHEME);

            $secure = apply_filters('secure_auth_cookie', $secure, $id);

            $secure_logged_in_cookie = apply_filters('secure_logged_in_cookie', $secure_logged_in_cookie, $id, $secure);

            if ($secure) {
                $auth_cookie_name = SECURE_AUTH_COOKIE;
                $scheme           = 'secure_auth';
            } else {
                $auth_cookie_name = AUTH_COOKIE;
                $scheme           = 'auth';
            }

            $hashed_token = (new Token)->hashToken($refresh_token);

            $auth_cookie      = wp_generate_auth_cookie($id, $expiration, $scheme, $hashed_token);
            $logged_in_cookie = wp_generate_auth_cookie($id, $expiration, 'logged_in', $hashed_token);

            do_action('set_auth_cookie', $auth_cookie, $expire, $expiration, $id, $scheme, $hashed_token);

            do_action('set_logged_in_cookie', $logged_in_cookie, $expire, $expiration, $id, 'logged_in', $hashed_token);

            if (!apply_filters('send_auth_cookies', true, $expire, $expiration, $id, $scheme, $hashed_token)) {
                return;
            }

            setcookie($auth_cookie_name, $auth_cookie, $expire, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
            setcookie($auth_cookie_name, $auth_cookie, $expire, ADMIN_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
            setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);

            if (COOKIEPATH != SITECOOKIEPATH) {
                setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
            }

            return $hashed_token;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
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
