<?php

namespace SEVEN_TECH\User;

use Exception;

use SEVEN_TECH\Validator\Validator;

class User
{
    private $validator;

    public function __construct()
    {
        $this->validator = new Validator();
    }

    public function findUserByEmail($email)
    {
        try {
            $validEmail = $this->validator->validEmail($email);

            if (!$validEmail) {
                throw new Exception('Email is not valid');
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }
            
            if (!$results || empty($results)) {
                return '';
            }

            return $results[0];
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function verifyAccount($email, $password, $confirmationCode)
    {
        $validConfirmationCode = $this->validator->validateConfirmationCode($email, $confirmationCode);

        if (!$validConfirmationCode) {
            return false;
        }

        $password = $this->validator->validPassword($password);

        if (!$password) {
            return false;
        }

        return $this->findUserByEmail($email);
    }
}
