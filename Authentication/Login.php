<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Details;
use SEVEN_TECH\Gateway\Cookie\Cookie;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Session\Session;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

use Exception;

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
                (new Details())->isAuthenticated($account->id);
            }

            $signedInUser = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);

            return new Authenticated($signedInUser->idToken(), $signedInUser->refreshToken());
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function withTokens(string $accessToken, string $refreshToken)
    {
        try {
            return new Authenticated($accessToken, $refreshToken);
        } catch (FailedToVerifyToken $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function persist(Authenticated $authenticated)
    {
        try {
            wp_set_current_user($authenticated->id);

            $session = new Session($authenticated, $_SERVER['REMOTE_ADDR'], $authenticated->location, $_SERVER['HTTP_USER_AGENT']);

            (new Cookie())->set($session);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in.', 403);
            }

            return $session->create();
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
