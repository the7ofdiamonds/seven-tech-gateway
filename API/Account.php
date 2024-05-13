<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Admin\AdminAccountManagement;
use SEVEN_TECH\Gateway\Validator\Validator;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Account
{
    private $adminaccountmngmnt;
    private $validator;
    private $token;

    public function __construct(Auth $auth)
    {
        $this->token = new Token($auth);
        $this->adminaccountmngmnt = new AdminAccountManagement;
        $this->validator = new Validator;
    }

    function verifyAccount(WP_REST_Request $request)
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

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];

            $validEmail = $this->validator->validEmail($email);

            if (!$validEmail) {
                $statusCode = 400;
                throw new Exception('Email is not valid.', $statusCode);
            }

            $validPassword = $this->validator->validPassword($password);

            if (!$validPassword) {
                $statusCode = 400;
                throw new Exception('Password is not valid.', $statusCode);
            }

            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                $statusCode = 400;
                throw new Exception('Confirmation code is not valid.', $statusCode);
            }

            return $this->adminaccountmngmnt->unlockAccount($email);
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

    function removeAccount(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];

            $validEmail = $this->validator->validEmail($email);

            if (!$validEmail) {
                $statusCode = 400;
                throw new Exception('Email is not valid.', $statusCode);
            }

            $validPassword = $this->validator->validPassword($password);

            if (!$validPassword) {
                $statusCode = 400;
                throw new Exception('Password is not valid.', $statusCode);
            }

            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                $statusCode = 400;
                throw new Exception('Confirmation code is not valid.', $statusCode);
            }

            return $this->adminaccountmngmnt->removeAccount($email);
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
            error_log('There has been an error at remove account');
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
