<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Cookie\Cookie;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Session\Session;

class Login
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = new FirebaseAuth;
    }

    function withEmailAndPassword(string $email, string $password)
    {
        try {
            $account = new Account($email);

            if ($password !== '') {
                (new Password)->matchesHash($password, $account->password);
            }

            if (!$account->isAuthenticated) {
                (new Details())->isAuthenticated($account);
            }

            $signedInUser = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);

            return new Authenticated($signedInUser->idToken(), $signedInUser->refreshToken());
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function withTokens(string $accessToken, string $refreshToken)
    {
        try {
            return new Authenticated($accessToken, $refreshToken);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function persist(Authenticated $authenticated, $location) : bool
    {
        try {
            $session = new Session($authenticated, $_SERVER['REMOTE_ADDR'], $location, $_SERVER['HTTP_USER_AGENT']);

            $cookie = new Cookie();
            $cookie->set($session);

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
