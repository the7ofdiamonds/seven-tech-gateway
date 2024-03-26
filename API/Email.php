<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Email
{

    private $token;

    public function __construct($auth)
    {
        $this->token = new Token($auth);
    }

    function verifyEmail(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            $verifyEmailResponse = [
                'successMessage' => $email
            ];

            return rest_ensure_response($verifyEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at verify email.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function addEmail(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            $addEmailResponse = [
                'successMessage' => $email
            ];

            return rest_ensure_response($addEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at add email.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function removeEmail(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];

            $removeEmailResponse = [
                'successMessage' => $email
            ];

            return rest_ensure_response($removeEmailResponse);
        } catch (Exception $e) {
            error_log('There has been an error at remove email.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
