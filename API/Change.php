<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

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
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);

            $email = $userData->email;
            $password = $userData->password;

            $firstname = $request['firstname'];

            if (empty($firstname)) {
                $statusCode = 400;
                $changeNameResponse = [
                    'errorMessage' => 'First name is required.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $lastname = $request['lastname'];

            if (empty($lastname)) {
                $statusCode = 400;
                $changeNameResponse = [
                    'errorMessage' => 'Last name is required.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status($statusCode);

                return $response;
            }

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
                $statusCode = 400;
                $changeNameResponse = [
                    'errorMessage' => 'First name could not be changed at this time.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status($statusCode);

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
                $statusCode = 400;
                $changeNameResponse = [
                    'errorMessage' => 'Last name could not be changed at this time.',
                ];

                $response = rest_ensure_response($changeNameResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $statusCode = 201;
            $changeNameResponse = [
                'successMessage' => "Your name has been changed to {$firstname} {$lastname} succesfully.",
                'firstname' => $firstname,
                'lastname' => $lastname,
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($changeNameResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (FailedToVerifyToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at change name.');
            $message = [
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }


    function changePhone(WP_REST_Request $request)
    {
        try {
            $phone = '+' . $request['phone'];
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
                $statusCode = 500;
                $changePhoneResponse = [
                    'errorMessage' => 'Phone number could not be changed at this time.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($changePhoneResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $statusCode = 201;
            $changePhoneResponse = [
                'successMessage' => "You phone number has been changed to {$phone} succesfully.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($changePhoneResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (FailedToVerifyToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at change phone.');
            $message = [
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
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
                $statusCode = 500;
                $updateUsernameResponse = [
                    'errorMessage' => 'Username could not be updated at this time.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($updateUsernameResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $statusCode = 201;
            $updateUsernameResponse = [
                'successMessage' => "Username has been changed to {$username} succesfully.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($updateUsernameResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (FailedToVerifyToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at change username');
            $message = [
                'message' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}