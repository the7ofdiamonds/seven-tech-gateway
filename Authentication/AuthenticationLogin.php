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
            (new DatabaseExists)->existsByEmail($email);
            (new Validator)->isValidPassword($password);

            $authentication = new Authentication($email);

            $password_check = (new Password)->passwordMatchesHash($password, $authentication->password);

            if (!$password_check) {
                throw new Exception('The password you entered for this username is not correct.', 400);
            }

            $signedInUser = $this->firebaseAuth->signInWithEmailAndPassword($email, $password);

            $user = $this->firebaseAuth->getUserByID($signedInUser->data()['localId']);

            $authentication->isAuthenticated($password);

            return new Authenticated($email, $signedInUser, $user);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
