<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Change
{
    function changeName()
    {
    }

    function changePassword()
    {
    }

    function updatePassword(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $confirmationCode = $request['confirmationCode'];
            $password = password_hash($request['password'], PASSWORD_DEFAULT);;

            if (empty($username)) {
                $message = [
                    'errorMessage' => 'A Username or email is required to update password',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            if (empty($confirmationCode)) {
                $message = [
                    'errorMessage' => 'A Confirmation Code is required to update password',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            if (empty($password)) {
                $message = [
                    'errorMessage' => "A Password is required to update password.",
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL updatePassword('$username', '$confirmationCode', '$password')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $updatePasswordResponse = [
                    'errorMessage' => 'Password could not be updated at this time.',
                ];

                $response = rest_ensure_response($updatePasswordResponse);
                $response->set_status(400);

                return $response;
            }

            $updatePasswordResponse = [
                'successMessage' => 'Password updated succesfully.',
            ];

            return $updatePasswordResponse;
        } catch (Exception $e) {
            error_log('There has been an error at update password');
            $message = [
                'errorMessage' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function changePhone()
    {
    }

    function changeUsername()
    {
    }

    function addEmail()
    {
    }

    function removeEmail()
    {
    }
}
