<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\AuthenticationLogin;
use SEVEN_TECH\Gateway\Authentication\AuthenticationToken;
use SEVEN_TECH\Gateway\Authentication\AuthenticationLogout;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Session\Session;
use SEVEN_TECH\Gateway\Session\SessionRedis;

use Exception;

use WP_REST_Request;

class API_Authentication
{
    private $login;
    private $token;
    private $logout;

    public function __construct(AuthenticationLogin $login, AuthenticationToken $token, AuthenticationLogout $logout)
    {
        $this->login = $login;
        $this->token = $token;
        $this->logout = $logout;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $authenticatedAccount = '';

            if (isset($request['email']) && isset($request['password'])) {
                $authenticatedAccount = $this->login->signInWithEmailAndPassword($request['email'], $request['password']);
            } else {
                $authenticatedAccount = $this->token->signInWithRefreshToken($request);
            }

            if ($authenticatedAccount == '') {
                throw new Exception('Access Denied: Either a token or username and password are required to login.', 403);
            }

            // if (isset($request['location'])) {
            //     $location = $request['location'];

            //     error_log(print_r($location, true));
            // }

            wp_set_current_user($authenticatedAccount->id);
            // (new Session)->createSesssion($authenticatedAccount->id, true, is_ssl(), $authenticatedAccount->refresh_token);
            (new SessionRedis)->createSession($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $authenticatedAccount);

            if (!is_user_logged_in()) {
                throw new Exception('You could not be logged in.', 403);
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'authenticatedAccount' => $authenticatedAccount,
                'statusCode' => 200
            ];

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
