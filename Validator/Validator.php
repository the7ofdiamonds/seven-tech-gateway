<?php

namespace SEVEN_TECH\Gateway\Validator;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Validator
{

    function isValidEmail($email)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required.');
            }

            $pattern = '/^([a-zA-Z0-9._-]+)@([a-zA-Z0-9._-]+)\.([a-zA-Z]+)$/';

            if (!preg_match($pattern, $email)) {
                throw new Exception('Email is not valid', 400);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isValidPassword($password)
    {
        try {
            if (empty($password)) {
                throw new Exception('Password is required.');
            }

            $pattern = '/[0-9a-zA-Z$@#%^&*_-]{8,20}$/';

            if (!preg_match($pattern, $password)) {
                throw new Exception('Password is not valid', 400);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isValidConfirmationCode($confirmationCode)
    {
        try {
            if (empty($confirmationCode)) {
                throw new Exception('Confirmation code is required.');
            }

            $pattern = '/^\[a-zA-Z0-9-]+$/';

            if (!preg_match($pattern, $confirmationCode)) {
                throw new Exception('Confirmation code is not valid.');
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
