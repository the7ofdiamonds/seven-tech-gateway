<?php

namespace SEVEN_TECH\Gateway\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Gateway\Authentication\Authentication;

use Kreait\Firebase\Auth;

class Login
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = new Authentication($auth);
    }

    function login(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $location = $request['location'];
            error_log(print_r($location, true));

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An Email is required for login.', $statusCode);
            }

            if (empty($password)) {
                $statusCode = 400;
                throw new Exception('A Password is required for login', $statusCode);
            }

            $loginResponse = $this->auth->login($email, $password);

            return rest_ensure_response($loginResponse);
        } catch (Exception $e) {
            error_log('There has been an error at login');
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
