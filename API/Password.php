<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Admin\AdminUserManagement;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

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
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'An email is required to reset password.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
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
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $email = $userData->email;
            $password = $userData->password;
            $newPassword = $request['password'];
            $confirmPassword = $request['confirmPassword'];

            if (empty($newPassword)) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'Enter your new preferred password.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
                return $response;
            }

            if (empty($confirmPassword)) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'Enter your new preferred password twice.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
                return $response;
            }

            if ($newPassword != $confirmPassword) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'Enter your new preferred password exactly the same twice.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
                return $response;
            }

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
                $statusCode = 400;
                $removeEmailResponse = [
                    'errorMessage' => 'Password could not be updated at this time.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($removeEmailResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $statusCode = 200;
            $removeEmailResponse = [
                'successMessage' => "The email {$email} has been removed from your account successfuly.",
                'statusCode' => $statusCode
            ];

            return rest_ensure_response($removeEmailResponse);
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
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'A Username or email is required to update password.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
                return $response;
            }

            if (empty($confirmationCode)) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => 'A Confirmation Code is required to update password.',
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
                return $response;
            }

            if (empty($password)) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => "A Password is required to update password.",
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);
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
                $statusCode = 400;
                $updatePasswordResponse = [
                    'errorMessage' => 'Password could not be updated at this time.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($updatePasswordResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $statusCode = 201;
            $updatePasswordResponse = [
                'successMessage' => 'Password updated succesfully.',
                'statusCode' => $statusCode
            ];

            return rest_ensure_response($updatePasswordResponse);
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
