<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Password\Password;

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
            error_log('There has been an error at recover password.');
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

    function changePassword(WP_REST_Request $request)
    {
        try {            
            $removeEmailResponse = [
                'successMessage' => $this->password->changePassword($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at change password.');
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

    function updatePassword(WP_REST_Request $request)
    {
        try {
            $updatePasswordResponse = [
                'successMessage' => $this->password->updatePassword($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($updatePasswordResponse);
        } catch (Exception $e) {
            error_log('There has been an error at update password.');
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
