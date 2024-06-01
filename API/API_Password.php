<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;

use Exception;

use WP_REST_Request;

class API_Password
{
    private $password;

    public function __construct()
    {
        $this->password = new Password;
    }

    function recoverPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                throw new Exception('An email is required to reset password.', 400);
            }

            $response = $this->password->recoverPassword($email);

            return rest_ensure_response($response);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function changePassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $newPassword = $request['newPassword'];
            $confirmPassword = $request['confirmPassword'];

            $removeEmailResponse = [
                'successMessage' => $this->password->changePassword($email, $password, $newPassword, $confirmPassword),
                'statusCode' => 200
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function updatePassword(WP_REST_Request $request)
    {
        try {
            if (!isset($request['email'])) {
                throw new Exception('An email is required.', 400);
            }

            if (!isset($request['confirmationCode'])) {
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];

            $verified = (new Authentication($email))->verifyCredentials($confirmationCode);

            if (!$verified) {
                throw new Exception('Credentials are not valid password could not be updated at this time.', 403);
            }

            $password = $request['password']; 
            $confirmPassword = $request['confirmPassword'];

            $updatePasswordResponse = [
                'successMessage' => $this->password->updatePassword($email, $confirmationCode, $password, $confirmPassword),
                'statusCode' => 200
            ];

            return rest_ensure_response($updatePasswordResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
