<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Authentication\Logout;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;
use WP_REST_Request;
use WP_REST_Response;

class Authentication
{
    private $login;
    private $logout;
    private $token;

    public function __construct()
    {
        $this->login = new Login;
        $this->logout = new Logout;
        $this->token = new Token();
    }

    function login(WP_REST_Request $request)
    {
        try {

            if (isset($request['email']) && isset($request['password'])) {
                $authenticated = $this->login->withEmailAndPassword($request['email'], $request['password']);
            } else {
                // Needs a way to get the location
                $accessToken = $this->token->getAccessToken($request);
                $refreshToken = $this->token->getRefreshToken($request);
                $authenticated = $this->login->withTokens($accessToken, $refreshToken);
            }

            $authenticatedAccount = $this->login->persist($authenticated, $request['location']);

            if(!$authenticatedAccount) {
                throw new Exception("There was an error persisting your session please try again at another time.");
            }

            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'username' => $authenticated->username,
                'access_token' => $authenticated->access_token,
                'refresh_token' => $authenticated->refresh_token,
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($loginResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logout(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getAccessToken($request);
            $refreshToken = $this->token->getRefreshToken($request);

            $auth = new Authenticated($accessToken, $refreshToken);

            $this->logout->session($auth);

            $logoutResponse = [
                'successMessage' => 'You have been logged out',
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($logoutResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function logoutAll(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getAccessToken($request);
            $refreshToken = $this->token->getRefreshToken($request);
            $auth = new Authenticated($accessToken, $refreshToken);
            $account = new Account($auth->email);

            $this->logout->all($account);

            $logoutAllResponse = [
                'successMessage' => 'You have been logged out of all accounts successfully',
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($logoutAllResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
