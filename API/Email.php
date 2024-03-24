<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Email
{

    function verifyEmail(WP_REST_Request $request)
    {
        try {
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
