<?php

namespace SEVEN_TECH\User;

use Exception;

use SEVEN_TECH\Validator\Validator;

class User
{
    private $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    public function addNewUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
    {

        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL addNewUser('%s', '%s','%s','%s','%s','%s','%s','%s','%s','%s')", $email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $confirmationCode)
        );

        if ($wpdb->last_error) {
            error_log("Error executing stored procedure: " . $wpdb->last_error);
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
        }

        if (empty($results[0])) {
            error_log("User could not be added.");
            return '';
        }

        return $results[0];
    }

    public function findUserByEmail($email)
    {
        try {
            // $validEmail = $this->validator->validEmail($email);

            // if (!$validEmail) {
            //     throw new Exception('Email is not valid', 400);
            // }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0])) {
                error_log("User could not be found.");
                return '';
            }

            return $results[0];
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function verifyAccount($email, $password, $confirmationCode)
    {
        $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

        if (!$validConfirmationCode) {
            return false;
        }

        $password = $this->validator->validPassword($password);

        if (!$password) {
            return false;
        }

        $user = $this->findUserByEmail($email);

        $password_check = wp_check_password($password, $user->password, $user->id);

        if (!$password_check) {
            return false;
        }

        if ($confirmationCode != $user->confirmationCode) {
            return false;
        }

        return true;
    }
}
