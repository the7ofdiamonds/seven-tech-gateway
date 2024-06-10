<?php

namespace SEVEN_TECH\Gateway\Cookie;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Session\Session;

use Exception;

use WP_Session_Tokens;

class Cookie
{
    public string $email;
    public int $expiration;
    public string $verifier;
    public bool $isUser;
    public bool $isValid = false;

    function set(Session $session)
    {
        try {
            $secure_logged_in_cookie = $session->secure && 'https' === parse_url(get_option('home'), PHP_URL_SCHEME);

            $secure = apply_filters('secure_auth_cookie', $session->secure, $session->id);

            $secure_logged_in_cookie = apply_filters('secure_logged_in_cookie', $secure_logged_in_cookie, $session->id, $secure);

            $auth_cookie      = wp_generate_auth_cookie($session->id, $session->expiration, $session->scheme, $session->hashed_token);
            $logged_in_cookie = wp_generate_auth_cookie($session->id, $session->expiration, 'logged_in', $session->hashed_token);

            do_action('set_auth_cookie', $auth_cookie, $session->expire, $session->expiration, $session->id, $session->scheme, $session->hashed_token);

            do_action('set_logged_in_cookie', $logged_in_cookie, $session->expire, $session->expiration, $session->id, 'logged_in', $session->hashed_token);

            if (!apply_filters('send_auth_cookies', true, $session->expire, $session->expiration, $session->id, $session->scheme, $session->hashed_token)) {
                error_log('unable to send auth cookies');
                return;
            }

            setcookie($session->auth_cookie_name, $auth_cookie, $session->expire, PLUGINS_COOKIE_PATH, COOKIE_DOMAIN, $session->secure, true);
            setcookie($session->auth_cookie_name, $auth_cookie, $session->expire, ADMIN_COOKIE_PATH, COOKIE_DOMAIN, $session->secure, true);
            setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, COOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
            
            if (COOKIEPATH != SITECOOKIEPATH) {
                setcookie(LOGGED_IN_COOKIE, $logged_in_cookie, $session->expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure_logged_in_cookie, true);
            }
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function validate_auth_cookie($cookie = '', $scheme = '')
    {
        $cookie_elements = wp_parse_auth_cookie($cookie, $scheme);
        if (!$cookie_elements) {
            /**
             * Fires if an authentication cookie is malformed.
             *
             * @since 2.7.0
             *
             * @param string $cookie Malformed auth cookie.
             * @param string $scheme Authentication scheme. Values include 'auth', 'secure_auth',
             *                       or 'logged_in'.
             */
            do_action('auth_cookie_malformed', $cookie, $scheme);

            error_log('auth cookie malformed');
            return false;
        }

        $scheme     = $cookie_elements['scheme'];
        $username   = $cookie_elements['username'];
        $hmac       = $cookie_elements['hmac'];
        $token      = $cookie_elements['token'];
        $expired    = $cookie_elements['expiration'];
        $expiration = $cookie_elements['expiration'];

        // Allow a grace period for POST and Ajax requests.
        if (wp_doing_ajax() || 'POST' === $_SERVER['REQUEST_METHOD']) {
            $expired += HOUR_IN_SECONDS;
        }

        // Quick check to see if an honest cookie has expired.
        if ($expired < time()) {
            /**
             * Fires once an authentication cookie has expired.
             *
             * @since 2.7.0
             *
             * @param string[] $cookie_elements {
             *     Authentication cookie components. None of the components should be assumed
             *     to be valid as they come directly from a client-provided cookie value.
             *
             *     @type string $username   User's username.
             *     @type string $expiration The time the cookie expires as a UNIX timestamp.
             *     @type string $token      User's session token used.
             *     @type string $hmac       The security hash for the cookie.
             *     @type string $scheme     The cookie scheme to use.
             * }
             */
            do_action('auth_cookie_expired', $cookie_elements);
            error_log('auth cookie expired');

            return false;
        }

        $user = get_user_by('login', $username);
        if (!$user) {
            /**
             * Fires if a bad username is entered in the user authentication process.
             *
             * @since 2.7.0
             *
             * @param string[] $cookie_elements {
             *     Authentication cookie components. None of the components should be assumed
             *     to be valid as they come directly from a client-provided cookie value.
             *
             *     @type string $username   User's username.
             *     @type string $expiration The time the cookie expires as a UNIX timestamp.
             *     @type string $token      User's session token used.
             *     @type string $hmac       The security hash for the cookie.
             *     @type string $scheme     The cookie scheme to use.
             * }
             */
            do_action('auth_cookie_bad_username', $cookie_elements);
            error_log('auth_cookie_bad_username');
            return false;
        }

        $pass_frag = substr($user->user_pass, 8, 4);

        $key = wp_hash($username . '|' . $pass_frag . '|' . $expiration . '|' . $token, $scheme);

        // If ext/hash is not present, compat.php's hash_hmac() does not support sha256.
        $algo = function_exists('hash') ? 'sha256' : 'sha1';
        $hash = hash_hmac($algo, $username . '|' . $expiration . '|' . $token, $key);

        if (!hash_equals($hash, $hmac)) {
            /**
             * Fires if a bad authentication cookie hash is encountered.
             *
             * @since 2.7.0
             *
             * @param string[] $cookie_elements {
             *     Authentication cookie components. None of the components should be assumed
             *     to be valid as they come directly from a client-provided cookie value.
             *
             *     @type string $username   User's username.
             *     @type string $expiration The time the cookie expires as a UNIX timestamp.
             *     @type string $token      User's session token used.
             *     @type string $hmac       The security hash for the cookie.
             *     @type string $scheme     The cookie scheme to use.
             * }
             */
            do_action('auth_cookie_bad_hash', $cookie_elements);
            error_log('auth_cookie_bad_hash');
            return false;
        }

        $manager = WP_Session_Tokens::get_instance($user->ID);
        if (!$manager->verify($token)) {
            /**
             * Fires if a bad session token is encountered.
             *
             * @since 4.0.0
             *
             * @param string[] $cookie_elements {
             *     Authentication cookie components. None of the components should be assumed
             *     to be valid as they come directly from a client-provided cookie value.
             *
             *     @type string $username   User's username.
             *     @type string $expiration The time the cookie expires as a UNIX timestamp.
             *     @type string $token      User's session token used.
             *     @type string $hmac       The security hash for the cookie.
             *     @type string $scheme     The cookie scheme to use.
             * }
             */
            do_action('auth_cookie_bad_session_token', $cookie_elements);
            error_log('auth_cookie_bad_session_token');
            return false;
        }

        // Ajax/POST grace period set above.
        if ($expiration < time()) {
            $GLOBALS['login_grace_period'] = 1;
        }

        /**
         * Fires once an authentication cookie has been validated.
         *
         * @since 2.7.0
         *
         * @param string[] $cookie_elements {
         *     Authentication cookie components.
         *
         *     @type string $username   User's username.
         *     @type string $expiration The time the cookie expires as a UNIX timestamp.
         *     @type string $token      User's session token used.
         *     @type string $hmac       The security hash for the cookie.
         *     @type string $scheme     The cookie scheme to use.
         * }
         * @param WP_User  $user            User object.
         */
        do_action('auth_cookie_valid', $cookie_elements, $user);

        return $user->ID;
    }

    function isValid(array $cookies)
    {
        $matchingCookies = [];

        foreach ($cookies as $key => $value) {
            if (strpos($key, 'wordpress_logged_in_') === 0) {
                $matchingCookies[$key] = $value;
            }
        }

        foreach ($matchingCookies as $matchingCookieKey => $matchingCookieValue) {
            $cookieParts = explode('|', $matchingCookieValue);

            //     $this->email = $cookieParts[0];
            //     $this->expiration = $cookieParts[1];
            //     $this->verifier = $cookieParts[2];

            //     if (time() > $this->expiration) {
            //         error_log('Cookie expired.');
            //     }

            //     $account = new Account($this->email);

            //     if ($account instanceof Account) {
            //         $this->isValid = true;
            //     }
        }
        return $this->isValid;
    }
}
