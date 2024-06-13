<?php

namespace SEVEN_TECH\Gateway\Cookie;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionRedis;
use SEVEN_TECH\Gateway\Session\SessionWordpress;

use Exception;

use WP_Session_Tokens;

class Cookie
{
    public int $user_id;
    public string $verifier = '';
    public bool $isUser;
    public string $scheme = 'auth';
    public string $email;
    public string $hmac;
    public string $token;
    public string $expired;
    public string $expiration;

    public function __construct(array $cookies = null)
    {
        if (is_array($cookies)) {
            $matchingCookies = [];

            foreach ($cookies as $key => $value) {
                if (strpos($key, 'wordpress_') === 0) {
                    if (strpos($key, 'wordpress_test_cookie') === 0) {
                        continue;
                    }

                    $matchingCookies[$key] = $value;
                }
            }

            foreach ($matchingCookies as $matchingCookieKey => $matchingCookieValue) {
                if (strpos($matchingCookieKey, 'wordpress_logged_in_') === 0) {
                    $this->scheme = 'logged_in';
                }

                $cookie_elements = wp_parse_auth_cookie($matchingCookieValue, $this->scheme);

                $this->email = $cookie_elements['username'];
                $this->hmac = $cookie_elements['hmac'];
                $this->token = $cookie_elements['token'];
                $this->expired = $cookie_elements['expiration'];
                $this->expiration = $cookie_elements['expiration'];

                $account = new Account($this->email);
                $this->user_id = $account->id;

                $this->isValid($matchingCookieValue, $this->user_id, $this->expiration, $this->scheme, $this->token);
            }
        }
    }

    function generate($user_id, $expiration, $scheme = 'auth', $token = '')
    {
        $user = get_userdata($user_id);
        if (!$user) {
            return '';
        }

        if (!$token) {
            $manager = WP_Session_Tokens::get_instance($user_id);
            $token   = $manager->create($expiration);
        }

        $pass_frag = substr($user->user_pass, 8, 4);

        $key = wp_hash($user->user_login . '|' . $pass_frag . '|' . $expiration . '|' . $token, $scheme);

        $algo = function_exists('hash') ? 'sha256' : 'sha1';
        $hash = hash_hmac($algo, $user->user_login . '|' . $expiration . '|' . $token, $key);

        $cookie = $user->user_login . '|' . $expiration . '|' . $token . '|' . $hash;

        return apply_filters('auth_cookie', $cookie, $user_id, $expiration, $scheme, $token);
    }


    function set(Session $session)
    {
        $secure_logged_in_cookie = $session->secure && 'https' === parse_url(get_option('home'), PHP_URL_SCHEME);

        $secure = apply_filters('secure_auth_cookie', $session->secure, $session->id);

        $secure_logged_in_cookie = apply_filters('secure_logged_in_cookie', $secure_logged_in_cookie, $session->id, $secure);

        if ($secure) {
            $auth_cookie_name = SECURE_AUTH_COOKIE;
            $scheme           = 'secure_auth';
        } else {
            $auth_cookie_name = AUTH_COOKIE;
            $scheme           = 'auth';
        }

        $auth_cookie      = $this->generate($session->id, $session->expiration, $session->scheme, $session->token);
        $logged_in_cookie = $this->generate($session->id, $session->expiration, 'logged_in', $session->token);

        do_action('set_auth_cookie', $auth_cookie, $session->expire, $session->expiration, $session->id, $session->scheme, $session->token);

        do_action('set_logged_in_cookie', $logged_in_cookie, $session->expire, $session->expiration, $session->id, 'logged_in', $session->token);

        /**
         * Allows preventing auth cookies from actually being sent to the client.
         *
         * @since 4.7.4
         * @since 6.2.0 The `$expire`, `$expiration`, `$user_id`, `$scheme`, and `$token` parameters were added.
         *
         * @param bool   $send       Whether to send auth cookies to the client. Default true.
         * @param int    $expire     The time the login grace period expires as a UNIX timestamp.
         *                           Default is 12 hours past the cookie's expiration time. Zero when clearing cookies.
         * @param int    $expiration The time when the logged-in authentication cookie expires as a UNIX timestamp.
         *                           Default is 14 days from now. Zero when clearing cookies.
         * @param int    $user_id    User ID. Zero when clearing cookies.
         * @param string $scheme     Authentication scheme. Values include 'auth' or 'secure_auth'.
         *                           Empty string when clearing cookies.
         * @param string $token      User's session token to use for this cookie. Empty string when clearing cookies.
         */
        if (!apply_filters('send_auth_cookies', true, $session->expire, $session->expiration, $session->id, $scheme, $session->token)) {
            return;
        }

        setcookie($auth_cookie_name, $auth_cookie, $session->expire, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
        setcookie($auth_cookie_name, $auth_cookie, $session->expire, ADMIN_COOKIE_PATH, COOKIE_DOMAIN, $secure, true);
        setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, COOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
        if (COOKIEPATH != SITECOOKIEPATH) {
            setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
        }
    }

    function isValid(string $cookie, int $user_id, int $expiration, string $scheme, string $token)
    {
        if (strpos($cookie, 'wordpress_logged_in_') === 0) {
            $scheme = 'logged_in';
        }

        $cookie_elements = wp_parse_auth_cookie($cookie, $scheme);

        if (!$cookie_elements) {
            do_action('auth_cookie_malformed', $cookie, $scheme);
            error_log('auth cookie malformed');
            return false;
        }

        // $scheme     = $cookie_elements['scheme'];
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
            error_log('auth cookie expired');

            return false;
        }

        $user = get_user_by('login', $username);
        if (!$user) {
            do_action('auth_cookie_bad_username', $cookie_elements);
            error_log('auth_cookie_bad_username');
            return false;
        }

        $pass_frag = substr($user->user_pass, 8, 4);

        $key = wp_hash($username . '|' . $pass_frag . '|' . $expiration . '|' . $token, $scheme);

        $algo = function_exists('hash') ? 'sha256' : 'sha1';
        $hash = hash_hmac($algo, $username . '|' . $expiration . '|' . $token, $key);

        if (!hash_equals($hash, $hmac)) {
            do_action('auth_cookie_bad_hash', $cookie_elements);
            error_log('auth_cookie_bad_hash');
            return false;
        }

        $verifySessionRedis = (new SessionRedis)->findSession($token);

        $verifier = hash('sha256', $token);
        $verifySessionWordpress = (new SessionWordpress)->findSession($user->id, $verifier);

        if (!$verifySessionRedis && !$verifySessionWordpress) {
            do_action('auth_cookie_bad_session_token', $cookie_elements);
            error_log('auth_cookie_bad_session_token');
            return false;
        }

        if ($expiration < time()) {
            $GLOBALS['login_grace_period'] = 1;
        }

        do_action('auth_cookie_valid', $cookie_elements, $user);

        return $cookie;
    }
}
