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

            $pattern = '/([a-zA-Z0-9._-]+)@([a-zA-Z0-9._-]+)\.([a-zA-Z]+)$/';
            $isValid = preg_match($pattern, $email);

            if ($isValid == 0) {
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
            $isValid = preg_match($pattern, $password);

            if ($isValid == 0) {
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

            $pattern = '/[a-zA-Z0-9-]+$/';
            $isValid = preg_match($pattern, $confirmationCode);

            if ($isValid == 0) {
                throw new Exception('Confirmation code is not valid.');
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isValidUsername($username)
    {
        try {
            if (empty($username)) {
                throw new Exception('Username is required.');
            }

            $pattern = '/[a-zA-Z0-9]{3,20}$/';
            $isValid = preg_match($pattern, $username);

            if ($isValid == 0) {
                throw new Exception('Username is not valid', 400);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isValidNicename($nicename)
    {
        try {
            if (empty($nicename)) {
                throw new Exception('Nicename is required.');
            }

            $pattern = '/[a-zA-Z0-9]{3,20}$/';
            $isValid = preg_match($pattern, $nicename);

            if ($isValid == 0) {
                throw new Exception('Nicename is not valid', 400);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isValidPhone($phone)
    {
        try {
            if (empty($phone)) {
                throw new Exception('Phone is required.');
            }

            $pattern = '/[0-9]{11,}$/';
            $isValid = preg_match($pattern, $phone);

            if ($isValid == 0) {
                throw new Exception('Phone is not valid', 400);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
