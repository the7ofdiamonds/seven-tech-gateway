<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Authentication
{
    private $authentication;

    public function __construct(Authentication $authentication)
    {
        $this->authentication = $authentication;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $loginResponse = $this->authentication->login($request);

            return rest_ensure_response($loginResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $logoutResponse = [
                'successMessage' => $this->authentication->logout($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($logoutResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logoutAll(WP_REST_Request $request)
    {
        try {
            $logoutAllResponse = [
                'successMessage' => $this->authentication->logoutAll($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($logoutAllResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
