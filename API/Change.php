<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Change
{
    private $token;

    public function __construct($auth)
    {
        $this->token = new Token($auth);
    }

    function changeName(WP_REST_Request $request)
    {
        try {
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeFirstName('$email', '$password', '$firstname')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $changeNameResponse = [
                    'errorMessage' => 'First name could not be changed at this time.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status(500);

                return $response;
            }

            $results = $wpdb->get_results(
                "CALL changeLastName('$email', '$password', '$lastname')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $changeNameResponse = [
                    'errorMessage' => 'Last name could not be changed at this time.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status(500);

                return $response;
            }

            $changeNameResponse = [
                'successMessage' => "Your name has been changed to {$firstname} {$lastname} succesfully.",
            ];

            return rest_ensure_response($changeNameResponse);
        } catch (Exception $e) {
            error_log('There has been an error at change name.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }


    function changePhone(WP_REST_Request $request)
    {
        try {
            $phone = '+'.$request['phone'];
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePhoneNumber('$email', '$password', '$phone')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $changePhoneResponse = [
                    'errorMessage' => 'Phone number could not be changed at this time.',
                ];

                $response = rest_ensure_response($changePhoneResponse);
                $response->set_status(500);

                return $response;
            }

            $changePhoneResponse = [
                'successMessage' => "You phone number has been changed to {$phone} succesfully.",
            ];

            return rest_ensure_response($changePhoneResponse);
        } catch (Exception $e) {
            error_log('There has been an error at change phone.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function changeUsername(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeUsername('$email', '$password', '$username')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $updateUsernameResponse = [
                    'errorMessage' => 'Username could not be updated at this time.',
                ];

                $response = rest_ensure_response($updateUsernameResponse);
                $response->set_status(500);

                return $response;
            }

            $updateUsernameResponse = [
                'successMessage' => "Username has been changed to {$username} succesfully.",
            ];

            return rest_ensure_response($updateUsernameResponse);
        } catch (Exception $e) {
            error_log('There has been an error at change username');
            $message = [
                'errorMessage' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
