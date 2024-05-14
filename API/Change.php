<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\User\User;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Change
{
    private $token;
    private $user;

    public function __construct(Auth $auth)
    {
        $this->token = new Token($auth);
        $this->user = new User;
    }

    // Send name changed email
    function changeName(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);

            $email = $userData->email;
            $password = $userData->password;

            $firstname = $request['firstName'];

            if (empty($firstname)) {
                $statusCode = 400;
                throw new Exception('First name is required.', $statusCode);
            }

            $lastname = $request['lastName'];

            if (empty($lastname)) {
                $statusCode = 400;
                throw new Exception('Last name is required.', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                "CALL changeFirstName('$email', '$password', '$firstname')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception('First name could not be changed at this time.', $statusCode);
            }

            $results = $wpdb->get_results(
                "CALL changeLastName('$email', '$password', '$lastname')"
            );

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 400;
                throw new Exception('Last name could not be changed at this time.', $statusCode);
            }

            $statusCode = 200;
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

    // Send phone number changed email
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
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 500;
                throw new Exception('Phone number could not be changed at this time.', $statusCode);
            }

            $statusCode = 200;
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

    // Send username changed email
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
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $results = $results[0]->resultSet;

            if (!$results) {
                $statusCode = 500;
                throw new Exception('Username could not be updated at this time.', $statusCode);
            }

            $statusCode = 200;
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

    public function changeUserNicename(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $id = $userData->id;
            $nicename = $request['nicename'];

            $statusCode = 200;
            $changeUserNicenameResponse = [
                'successMessage' => $this->user->changeUserNicename($id, $nicename),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($changeUserNicenameResponse);
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

    public function addUserRole(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $id = $userData->id;
            $roleName = $request['role_name'];
            $roleDisplayName = $request['role_display_name'];

            $statusCode = 200;
            $addUserRoleResponse = [
                'successMessage' => $this->user->addUserRole($id, $roleName, $roleDisplayName),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($addUserRoleResponse);
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

    public function removeUserRole(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getToken($request);
            $userData = $this->token->findUserWithToken($accessToken);
            $id = $userData->id;
            $roleName = $request['role_name'];
            $roleDisplayName = $request['role_display_name'];

            $statusCode = 200;
            $removeUserRoleResponse = [
                'successMessage' => $this->user->removeUserRole($id, $roleName, $roleDisplayName),
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($removeUserRoleResponse);
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
