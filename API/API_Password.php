<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Email\EmailPassword;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\PasswordChange;

use Exception;

use WP_REST_Request;

class API_Password
{
    private $passwordChange;

    public function __construct(PasswordChange $passwordChange)
    {
        $this->passwordChange = $passwordChange;
    }

    function recoverPassword(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            if (empty($email)) {
                throw new Exception('An email is required to reset password.', 400);
            }

            $response = (new EmailPassword)->recoverPassword($email);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
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
                'successMessage' => $this->passwordChange->changePassword($email, $password, $newPassword, $confirmPassword),
                'statusCode' => 200
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
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
                'successMessage' => $this->passwordChange->updatePassword($email, $confirmationCode, $password, $confirmPassword),
                'statusCode' => 200
            ];

            return rest_ensure_response($updatePasswordResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
