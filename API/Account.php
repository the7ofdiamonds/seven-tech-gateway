<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Admin\AdminAccountManagement;
use SEVEN_TECH\Validator\Validator;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Account
{
    private $adminaccountmngmnt;
    private $validator;

    public function __construct()
    {
        $this->adminaccountmngmnt = new AdminAccountManagement;
        $this->validator = new Validator;
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
                $signupResponse = [
                    'errorMessage' => 'Email is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $validPassword = $this->validator->validPassword($password);

            if (!$validPassword) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'Password is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'Confirmation code is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            return $this->adminaccountmngmnt->unlockAccount($email);
        } catch (Exception $e) {
            error_log('There has been an error at unlock account');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
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
                $signupResponse = [
                    'errorMessage' => 'Email is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $validPassword = $this->validator->validPassword($password);

            if (!$validPassword) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'Password is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'Confirmation code is not valid.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
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
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
