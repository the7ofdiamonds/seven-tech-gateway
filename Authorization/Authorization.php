<?php

namespace SEVEN_TECH\Gateway\Authorization;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

use WP_REST_Request;

class Authorization
{
    private $validator;
    private $token;

    public function __construct(Token $token)
    {
        $this->validator = new Validator;
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
                throw new Exception('Email is not valid.', 400);
            }

            $validPassword = $this->validator->validPassword($password);

            if (!$validPassword) {
                throw new Exception('Password is not valid.', 400);
            }

            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                throw new Exception('Confirmation code is not valid.', 400);
            }

            // Verify Credentials stored procedure
            // if (!$verifiedCredentials) {
            //     throw new Exception('Unauthorized credentials could not be verified.', 403);
            // }

            $userData = $this->token->findUserWithToken($request);

            return $userData;
        } catch (Exception | DestructuredException $e) {
            throw new DestructuredException($e);
        }
    }
}
