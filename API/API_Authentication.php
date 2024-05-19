<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;

use Exception;

use WP_REST_Request;

class API_Authentication
{
    private $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $location = $request['location'];
            error_log(print_r($location, true));

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An Email is required for login.', $statusCode);
            }

            if (empty($password)) {
                $statusCode = 400;
                throw new Exception('A Password is required for login', $statusCode);
            }

            $loginResponse = $this->auth->login($email, $password);

            return rest_ensure_response($loginResponse);
        } catch (Exception $e) {
            error_log('There has been an error at login');
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    // Authentication
    function verifyCredentials(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;
            $confirmationCode = $request['confirmationCode'];

            if (empty($confirmationCode)) {
                $statusCode = 400;
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL enableAccount('$email', '$password', '$confirmationCode')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception("There was an error verifying your account please try again at another time.", $statusCode);
            }

            $statusCode = 200;
            $verifyEmailResponse = [
                'successMessage' => 'Email has been verified.',
                'statusCode' => $statusCode
            ];

            return rest_ensure_response($verifyEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at verify email.');
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An Email is required to logout', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByEmail(%s)", $email)
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $userExists = $results[0]->resultSet;

            if (!$userExists) {
                $statusCode = 404;
                throw new Exception('User could not be found', $statusCode);
            }

            wp_logout();

            if (is_user_logged_in()) {
                $statusCode = 400;
                throw new Exception('User could not be logged out.', $statusCode);
            }

            $statusCode = 200;
            $logoutResponse = [
                'successMessage' => 'You have been logged out',
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($logoutResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }
}
