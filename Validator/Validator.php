<?php

namespace SEVEN_TECH\Validator;

use Exception;

class Validator
{

    function validEmail($email)
    {
        if (empty($email)) {
            throw new Exception('Email is required.');
        }

        $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/';

        if (preg_match($pattern, $email)) {
            return true;
        }

        return false;
    }

    function validPassword($password)
    {
        if (empty($password)) {
            throw new Exception('Password is required.');
        }

        $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/';

        if (preg_match($pattern, $password)) {
            return true;
        }

        return false;
    }

    function validConfirmationCode($confirmationCode)
    {
        if (empty($confirmationCode)) {
            throw new Exception('Confirmation code is required.');
        }

        $pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/';

        if (preg_match($pattern, $confirmationCode)) {
            return true;
        }

        return false;
    }
}
