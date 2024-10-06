<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Authentication\Logout;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Authentication
{
    private $login;
    private $logout;

    public function __construct()
    {
        $this->login = new Login;
        $this->logout = new Logout;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $loginResponse = $this->login->signIn($request);

            return rest_ensure_response($loginResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $logoutResponse = $this->logout->logout($request);

            return rest_ensure_response($logoutResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logoutAll(WP_REST_Request $request)
    {
        try {
            $logoutAllResponse = $this->logout->logoutAll($request);

            return rest_ensure_response($logoutAllResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
