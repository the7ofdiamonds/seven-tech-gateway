<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;

use Exception;

use WP_REST_Request;


class API_Password
{
    private $password;

    public function __construct(Password $password)
    {
        $this->password = $password;
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
            $removeEmailResponse = [
                'successMessage' => $this->password->changePassword($request),
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
            $updatePasswordResponse = [
                'successMessage' => $this->password->updatePassword($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($updatePasswordResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
