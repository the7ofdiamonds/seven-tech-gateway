<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Admin\AdminAccountManagement;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class API_Account
{
    private $adminaccountmngmnt;
    private $validator;
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
        $this->adminaccountmngmnt = new AdminAccountManagement;
        $this->validator = new Validator;
    }

    function createAccount(){}

    // lock account

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];
// Verify Credentials
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

    // Enable account
    
    function removeAccount(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];

// Verify Credentials
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

            return $this->adminaccountmngmnt->disableAccount($email);
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
