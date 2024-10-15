<?php

namespace SEVEN_TECH\Gateway\Cookie;

use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Token\Token;

class Cookie
{

    function determine_current_user()
    {
        $logged_in_cookie = '';

        foreach ($_COOKIE as $key => $value) {

            if (strpos($key, 'wordpress_logged_in_') !== false) {
                $logged_in_cookie = $value;
                break;
            }
        }

        $user_id = $this->auth_cookie_valid($logged_in_cookie);

        if(!is_int($user_id)) {
            wp_set_current_user(0);
        }

        wp_set_current_user($user_id);

        return $user_id;
    }

    function auth_cookie_valid($cookie)
    {
        $cookie_elements = wp_parse_auth_cookie($cookie, 'logged_in');

        if (!$cookie_elements) {
            do_action('auth_cookie_malformed', $cookie, 'logged_in');
            error_log('auth_cookie_malformed');
            return false;
        }

        $username   = $cookie_elements['username'];
        $hmac       = $cookie_elements['hmac'];
        $token      = $cookie_elements['token'];
        $expired    = $cookie_elements['expiration'];
        $expiration = $cookie_elements['expiration'];

        if (wp_doing_ajax() || 'POST' === $_SERVER['REQUEST_METHOD']) {
            $expired += HOUR_IN_SECONDS;
        }

        if ($expired < time()) {
            do_action('auth_cookie_expired', $cookie_elements);
            error_log('auth_cookie_expired');
            return false;
        }

        $user = get_user_by('login', $username);

        if (!$user) {
            do_action('auth_cookie_bad_username', $cookie_elements);
            error_log('auth_cookie_bad_username');
            return false;
        }

        $pass_frag = substr($user->user_pass, 8, 4);

        $hash = $this->hash($username, $pass_frag, $expiration, $token, 'logged_in');

        if (!hash_equals($hash, $hmac)) {
            do_action('auth_cookie_bad_hash', $cookie_elements);
            error_log('auth_cookie_bad_hash');
            return false;
        }

        $verifier = (new Token)->hashToken($token);

        $sessionVerified = (new Session)->find($verifier, $user->ID);

        if (!$sessionVerified) {
            do_action('auth_cookie_bad_session_token', $cookie_elements);
            error_log('auth_cookie_bad_session_token');
            return false;
        }

        if ($expiration < time()) {
            $GLOBALS['login_grace_period'] = 1;
            return false;
        }

        wp_set_current_user($user->ID);

        return $user->ID;
    }

    function hash($username, $pass_frag, $expiration, $token, $scheme)
    {
        $key = wp_hash($username . '|' . $pass_frag . '|' . $expiration . '|' . $token, $scheme);
        $algo = function_exists('hash') ? 'sha256' : 'sha1';
        $hash = hash_hmac($algo, $username . '|' . $expiration . '|' . $token, $key);

        return $hash;
    }

    function set(Session $session)
    {
        $secure_logged_in_cookie = $session->secure && 'https' === parse_url(get_option('home'), PHP_URL_SCHEME);

        $secure_logged_in_cookie = apply_filters('secure_logged_in_cookie', $secure_logged_in_cookie, $session->user_id, $session->secure);

        $auth_cookie = wp_generate_auth_cookie($session->user_id, $session->expiration, $session->scheme, $session->token);
        $logged_in_cookie = wp_generate_auth_cookie($session->user_id, $session->expiration, 'logged_in', $session->token);

        do_action('set_auth_cookie', $auth_cookie, $session->expire, $session->expiration, $session->user_id, $session->scheme, $session->token);
        do_action('set_logged_in_cookie', $logged_in_cookie, $session->expire, $session->expiration, $session->user_id, 'logged_in', $session->token);

        if (!apply_filters('send_auth_cookies', true, $session->expire, $session->expiration, $session->user_id, $session->scheme, $session->token)) {
            return;
        }

        setcookie($session->admin_cookie_name, $auth_cookie, $session->expire, ADMIN_COOKIE_PATH, COOKIE_DOMAIN, $session->secure, true);
        setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, COOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);

        if (COOKIEPATH != SITECOOKIEPATH) {
            setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
        }

        return $session->create();
    }
}
