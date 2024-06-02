<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

class EmailPassword
{
    private $exists;

    public function __construct()
    {
        $this->exists = new DatabaseExists;
    }

    function recoverPassword($email)
    {
        try {
            $this->exists->existsByEmail($email);

            $auth = new Authentication($email);

            $auth->updateConfirmationCode();

            $message = "An email has been sent to {$email} check your inbox for directions on how to reset your password. Confirmation Code: {$auth->confirmation_code}";
            error_log($message);
            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function passwordChanged($email)
    {
        $this->exists->existsByEmail($email);

        $message = "Your password has been changed.";
        error_log($message);
        return $message;
    }
}
