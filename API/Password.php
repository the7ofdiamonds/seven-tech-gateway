<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Admin\AdminUserManagement;

class Password
{
    private $adminusermngmnt;
    private $token;

    public function __construct($auth)
    {
        $this->adminusermngmnt = new AdminUserManagement;
        $this->token = new Token($auth);
    }

    function forgotPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                $message = [
                    'errorMessage' => 'An email is required to reset password.',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            $response = $this->adminusermngmnt->forgotPassword($email);

            return rest_ensure_response($response);
        } catch (Exception $e) {
            error_log('There has been an error at forgot password.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function changePassword(WP_REST_Request $request)
    {
        try {
            $newPassword = $request['password'];
            $confirmPassword = $request['confirmPassword'];

            if (empty($newPassword)) {
                $message = [
                    'errorMessage' => 'Enter your new preferred password.',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            if (empty($confirmPassword)) {
                $message = [
                    'errorMessage' => 'Enter your new preferred password twice.',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            if ($newPassword != $confirmPassword) {
                $message = [
                    'errorMessage' => 'Enter your new preferred password exactly the same twice.',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePassword('$email', '$password', '$newPassword')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $removeEmailResponse = [
                    'errorMessage' => 'Password could not be updated at this time.',
                ];

                $response = rest_ensure_response($removeEmailResponse);
                $response->set_status(400);

                return $response;
            }

            $removeEmailResponse = [
                'successMessage' => "The email {$email} has been removed from your account successfuly."
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at change password.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function updatePassword(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $confirmationCode = $request['confirmationCode'];
            $password = password_hash($request['password'], PASSWORD_DEFAULT);;

            if (empty($username)) {
                $message = [
                    'errorMessage' => 'A Username or email is required to update password.',
                ];
                $response = rest_ensure_response($message);
                $response->set_status(400);
                return $response;
            }

            if (empty($confirmationCode)) {
                $message = [
                    'errorMessage' => 'A Confirmation Code is required to update password.',
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
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
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
            error_log('There has been an error at update password.');
            $message = [
                'errorMessage' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
