<?php

namespace SEVEN_TECH\Gateway\Cookie;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Session\Session;

class Cookie
{
    public string $email;
    public int $expiration;
    public string $verifier;
    public bool $isUser;
    public bool $isValid = false;

    public function __construct(array $cookies)
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

            if (time() < $this->expiration) {
                error_log('Cookie expired.');
            }

            $account = new Account($this->email);

            if ($account instanceof Account) {
                $this->isValid = (new Session($account->id))->findSession($this->verifier);
            }
        }
    }
}
