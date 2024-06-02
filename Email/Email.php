<?php

namespace SEVEN_TECH\Gateway\Email;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

class Email
{
    private $validator;
    private $exists;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->exists = new DatabaseExists;
    }

    function recoverPassword($email)
    {
        try {
            $this->exists->existsByEmail($email);
            $confirmationCode = wp_generate_password(20, false);
// Update confirmation code stored procedure

            $message = "An email has been sent to {$email} check your inbox for directions on how to reset your password. Confirmation Code: {$confirmationCode}";

            return $message;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }

    function passwordChanged(){}

    function accountCreated(){}

    function accountLocked(){}

    function accountUnlocked(){}

    function accountDisabled(){}

    function accountEnabled(){}

    function accountDeleted(){}

    function roleAdded(){}

    function roleRemoved(){}

    function userAdded(){}

    function usernameChanged(){}

    function namechanged(){}

    function nicknameChanged(){}

    function nicenameChanged(){}

    function phoneChanged(){}
}
