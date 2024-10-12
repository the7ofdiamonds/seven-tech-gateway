<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Email\EmailPassword;
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

    function forgot(WP_REST_Request $request)
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

    function change(WP_REST_Request $request)
    {
        try {
            $this->password->change($request['email'], $request['password'], $request['newPassword'], $request['confirmPassword']);

            $removeEmailResponse = [
                'successMessage' => "Your password has been changed successfully an email has been sent to {$request['email']} check your inbox.",
                'statusCode' => 200
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function update(WP_REST_Request $request)
    {
        try {
            $this->password->update($request['email'], $request['confirmationCode'], $request['password'], $request['confirmPassword']);

            $updatePasswordResponse = [
                'successMessage' => 'Password updated succesfully.',
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
