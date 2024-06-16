<?php

namespace SEVEN_TECH\Gateway\Password;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Password
{
    private $validator;
    private $exists;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->exists = new DatabaseExists;
    }

    function passwordFrag($password)
    {
        return substr($password, 8, 4);
    }

    function hashPassword($password)
    {
        $this->validator->isValidPassword($password);

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        return $hashedPassword;
    }

    function passwordMatchesHash($password, $hash)
    {
        $this->validator->isValidPassword($password);

        $first_two_chars = substr($hash, 0, 2);

        if ($first_two_chars === '$P') {
            $password_check = wp_check_password($password, $hash);
        } else {
            $password_check = password_verify($password, $hash);
        }

        if (!$password_check) {
            throw new Exception('The password you entered for this username is not correct.', 400);
        }
        
        return $password_check;
    }

    function expireCredentials($email)
    {
        try {
            $this->exists->existsByEmail($email);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL expireCredentials('$email')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $credentialsExpired = $results[0]->resultSet;

            if ($credentialsExpired == 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            return $credentialsExpired;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unexpireCredentials($email, $password)
    {
        try {
            $this->exists->existsByEmail($email);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL unexpireCredentials('$email', '$password')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $credentialsExpired = $results[0]->resultSet;

            if ($credentialsExpired == 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            return $credentialsExpired;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
