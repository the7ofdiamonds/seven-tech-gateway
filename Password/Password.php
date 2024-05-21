<?php

namespace SEVEN_TECH\Gateway\Password;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Authentication\Authentication;

class Password
{
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    function recoverPassword($email)
    {
        try {
            if (empty($email)) {
                throw new Exception('An email is required to reset password.', 400);
            }

            $message = "An email has been sent to {$email} check your inbox for directions on how to reset your password.";

            return $message;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    // Send password changed email
    function changePassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $newPassword = $request['newPassword'];
            $confirmPassword = $request['confirmPassword'];

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL unexpireCredentials('$email', '$password')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            if (empty($newPassword)) {
                throw new Exception('Enter your new preferred password.', 400);
            }

            if (empty($confirmPassword)) {
                throw new Exception('Enter your new preferred password twice.', 400);
            }

            if ($newPassword != $confirmPassword) {
                throw new Exception('Enter your new preferred password exactly the same twice.', 400);
            }

            $results = $wpdb->get_results(
                "CALL changePassword('$email', '$password', '$newPassword')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            return "Your password has been changed successfully an email has been sent to {$email} check your inbox.";
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    // Send password changed email
    function updatePassword(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authentication->verifyCredentials($request);

            if (!$authorized) {
                throw new Exception('Credentials are not valid password could not be updated at this time.', 403);
            }

            if (empty($password)) {
                throw new Exception("A Password is required to update password.", 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];
            $password = password_hash($request['password'], PASSWORD_DEFAULT);;

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL updatePassword('$email', '$confirmationCode', '$password')"
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            $results = $results[0]->resultSet;

            if (empty($results)) {
                throw new Exception('Password could not be updated at this time.', 400);
            }

            return 'Password updated succesfully.';
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
