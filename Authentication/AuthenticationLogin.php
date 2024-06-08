<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Services\ServicesFirebase;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use Kreait\Firebase\Auth;

class AuthenticationLogin
{
    private $servicesFirebase;

    public function __construct(ServicesFirebase $servicesFirebase)
    {
        $this->servicesFirebase = $servicesFirebase;
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

            $signedInUser = $this->servicesFirebase->signInWithEmailAndPassword($email, $password);

            $user = $this->servicesFirebase->getUserByID($signedInUser->data()['localId']);

            $authentication->isAuthenticated($password);

            return new Authenticated($email, $signedInUser, $user);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
