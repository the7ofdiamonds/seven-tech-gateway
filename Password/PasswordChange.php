<?php

namespace SEVEN_TECH\Gateway\Password;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailPassword;
use SEVEN_TECH\Gateway\Services\Google\Firebase\FirebaseAuth;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class PasswordChange
{
    private $validator;
    private $exists;
    private $email;
private $firebaseAuth;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->exists = new DatabaseExists;
        $this->email = new EmailPassword;
        $this->firebaseAuth = new FirebaseAuth;
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

    function changePassword($email, $password, $newPassword, $confirmPassword)
    {
        try {
            $this->exists->existsByEmail($email);
            $this->validator->isValidPassword($password);

            if (empty($newPassword)) {
                throw new Exception('Enter your new preferred password.', 400);
            }

            if (empty($confirmPassword)) {
                throw new Exception('Enter your new preferred password twice.', 400);
            }

            $matches = $this->validator->matches($newPassword, $confirmPassword);

            if (!$matches) {
                throw new Exception('Enter your new preferred password exactly the same twice.', 400);
            }

            $hashedPassword = $this->hashPassword($newPassword);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePassword('$email', '$password', '$hashedPassword')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $passwordChanged = $results[0]->resultSet;

            if ($passwordChanged == 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            
            $auth = new Authentication($email);
            $this->firebaseAuth->changeFirebasePassword($auth->provider_given_id, $newPassword);

            $this->unexpireCredentials($email, $auth->password);

            $this->email->passwordChanged($email);

            return "Your password has been changed successfully an email has been sent to {$email} check your inbox.";
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updatePassword($email, $confirmationCode, $password, $confirmPassword)
    {
        try {
            $this->exists->existsByEmail($email);
            $this->validator->isValidPassword($password);
            $this->validator->isValidPassword($confirmPassword);

            $matches = $this->validator->matches($password, $confirmPassword);

            if (!$matches) {
                throw new Exception('Enter your new preferred password exactly the same twice.', 400);
            }

            $hashedPassword = $this->hashPassword($password);

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL updatePassword('$email', '$confirmationCode', '$hashedPassword')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (empty($results)) {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            $auth = new Authentication($email);

            $this->unexpireCredentials($email, $auth->password);

            $this->email->passwordChanged($email);

            return 'Password updated succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}