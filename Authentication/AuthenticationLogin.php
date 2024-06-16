<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class AuthenticationLogin
{
    private $firebaseAuth;

    public function __construct()
    {
        $this->firebaseAuth = new FirebaseAuth;
    }

    function signInWithEmailAndPassword($email, $password)
    {
        try {          
            $signedInUser = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);

            (new Authentication($email))->isAuthenticated($password);
            
            return new Authenticated($signedInUser->idToken(), $signedInUser->refreshToken());
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
