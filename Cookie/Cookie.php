<?php

namespace SEVEN_TECH\Gateway\Cookie;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Session\Session;

use Exception;

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

            $this->email = $cookieParts[0];
            $this->expiration = $cookieParts[1];
            $this->verifier = $cookieParts[2];

            if (time() > $this->expiration) {
                error_log('Cookie expired.');
            }

            $account = new Account($this->email);

            if ($account instanceof Account) {
                $this->isValid = (new Session())->findSession($this->verifier, $account->id);
            }
        }
    }
}
