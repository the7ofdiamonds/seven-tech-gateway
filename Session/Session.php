<?php

namespace SEVEN_TECH\Gateway\Session;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Session
{

    public function getSessions($id)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required.', 400);
            }

            $account_status = get_user_meta($id, 'session_tokens');

            if (empty($account_status)) {
                return '';
            }

            if (!$account_status) {
                throw new Exception('User ID is not valid.', 400);
            }

            return $account_status[0];
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function hash_token($token)
    {
        if (function_exists('hash')) {
            return hash('sha256', $token);
        } else {
            return sha1($token);
        }
    }

    function store_session($user_id, $token)
    {
        $session_tokens = $this->getSessions($user_id) ? $this->getSessions($user_id) : [];

        $session_token = array(
            'expiration' => time() + DAY_IN_SECONDS,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'ua' => $_SERVER['HTTP_USER_AGENT'],
            'login' => time()
        );

        $hashed_token = $this->hash_token($token);

        $session_tokens[$hashed_token] = $session_token;

        if (is_array($session_tokens)) {
            update_user_meta($user_id, 'session_tokens', $session_tokens);
        } else {
            add_user_meta($user_id, 'session_tokens', $session_tokens);
        }
    }

    function createSesssion($user_id, $remember = false, $secure = '', $token = '')
    {
        if ($remember) {
            $expiration = time() + apply_filters('auth_cookie_expiration', 14 * DAY_IN_SECONDS, $user_id, $remember);
            $expire = $expiration + (12 * HOUR_IN_SECONDS);
        } else {
            $expiration = time() + apply_filters('auth_cookie_expiration', 2 * DAY_IN_SECONDS, $user_id, $remember);
            $expire     = 0;
        }

        if ('' === $secure) {
            $secure = is_ssl();
        }

        $secure_logged_in_cookie = $secure && 'https' === parse_url(get_option('home'), PHP_URL_SCHEME);

        $secure = apply_filters('secure_auth_cookie', $secure, $user_id);

        $secure_logged_in_cookie = apply_filters('secure_logged_in_cookie', $secure_logged_in_cookie, $user_id, $secure);

        if ($secure) {
            $auth_cookie_name = SECURE_AUTH_COOKIE;
            $scheme           = 'secure_auth';
        } else {
            $auth_cookie_name = AUTH_COOKIE;
            $scheme           = 'auth';
        }

        $auth_cookie      = wp_generate_auth_cookie($user_id, $expiration, $scheme, $token);
        $logged_in_cookie = wp_generate_auth_cookie($user_id, $expiration, 'logged_in', $token);

        do_action('set_auth_cookie', $auth_cookie, $expire, $expiration, $user_id, $scheme, $token);

        do_action('set_logged_in_cookie', $logged_in_cookie, $expire, $expiration, $user_id, 'logged_in', $token);

        if (!apply_filters('send_auth_cookies', true, $expire, $expiration, $user_id, $scheme, $token)) {
            return;
        }

        setcookie($auth_cookie_name, $auth_cookie, $expire, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
        setcookie($auth_cookie_name, $auth_cookie, $expire, ADMIN_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
        setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $expire, COOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
        if (COOKIEPATH != SITECOOKIEPATH) {
            setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
        }

        $this->store_session($user_id, $token);
    }

    function destroy_session($refreshToken, $id)
    {
        $session_tokens = $this->getSessions($id);

        if (!is_array($session_tokens)) {
            return;
        }

        $verifier = $this->hash_token($refreshToken);

        foreach ($session_tokens as $key => $value) {
            if ($key == $verifier) {
                unset($session_tokens[$key]);
                break;
            }
        }

        $session_destroyed = update_user_meta($id, 'session_tokens', $session_tokens);

        return $session_destroyed;
    }
}
