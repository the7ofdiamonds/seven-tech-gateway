<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Change
{
    function changeName(WP_REST_Request $request)
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at change name.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

   
    function changePhone(WP_REST_Request $request)
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at change phone.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function changeUsername(WP_REST_Request $request)
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at change username');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
