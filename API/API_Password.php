<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Admin\AdminUserManagement;
use SEVEN_TECH\Gateway\User\User;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class API_Password
{
    private $adminusermngmnt;
    private $token;
    private $user;

    public function __construct(Auth $auth)
    {
        $this->adminusermngmnt = new AdminUserManagement;
        $this->token = new Token($auth);
        $this->user = new User;
    }

    function forgotPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An email is required to reset password.', $statusCode);
            }

            $response = $this->adminusermngmnt->forgotPassword($email);

            return rest_ensure_response($response);
        } catch (Exception $e) {
            error_log('There has been an error at forgot password.');
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

// Send password changed email
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
                throw new Exception('Enter your new preferred password.', $statusCode);
            }

            if (empty($confirmPassword)) {
                $statusCode = 400;
                throw new Exception('Enter your new preferred password twice.', $statusCode);
            }

            if ($newPassword != $confirmPassword) {
                $statusCode = 400;
                throw new Exception('Enter your new preferred password exactly the same twice.', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changePassword('$email', '$password', '$newPassword')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception('Password could not be updated at this time.', $statusCode);
            }

            $statusCode = 200;
            $removeEmailResponse = [
                'successMessage' => "Your password has been changed successfully an email has been sent to {$email} check your inbox.",
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

// Send password changed email
    function updatePassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];
            $password = password_hash($request['password'], PASSWORD_DEFAULT);;

            if (empty($username)) {
                $statusCode = 400;
                throw new Exception('A Username or email is required to update password.', $statusCode);
            }

            if (empty($confirmationCode)) {
                $statusCode = 400;
                throw new Exception('A Confirmation Code is required to update password.', $statusCode);
            }

            if (empty($password)) {
                $statusCode = 400;
                throw new Exception("A Password is required to update password.", $statusCode);
            }

            $verifiedAccount = $this->user->verifyAccount($email, $password, $confirmationCode);

            if (!$verifiedAccount) {
                $statusCode = 403;
                throw new Exception('Credentials are not valid password could not be updated at this time.', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL updatePassword('$email', '$confirmationCode', '$password')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception('Password could not be updated at this time.', $statusCode);
            }

            $statusCode = 200;
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
