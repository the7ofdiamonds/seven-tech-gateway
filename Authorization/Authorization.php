<?php

namespace SEVEN_TECH\Gateway\Authorization;

use SEVEN_TECH\Gateway\Token\Token;

use WP_REST_Request;

class Authorization
{
    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function verifyCredentials(WP_REST_Request $request)
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
        }
    }
}
