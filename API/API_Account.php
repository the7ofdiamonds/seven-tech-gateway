<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Create;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Authentication\Login;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;
use WP_REST_Response;

class API_Account
{
    public $token;

    public function __construct()
    {
        $this->token = new Token;
    }

    function register(WP_REST_Request $request)
    {
        try {
            (new Create)->account($request['email'], $request['username'], $request['password'], $request['confirmPassword'], $request['nicename'], $request['nickname'], $request['firstname'], $request['lastname'], $request['phone']);

            $auth = (new Login)->withEmailAndPassword($request['email'], $request['password']);
  
            $registeredAccountResponse = array(
                'successMessage' => 'You have been signed up successfully.',
                'username' => $auth->username,
                'refreshToken' => $auth->refresh_token,
                'accessToken' => $auth->access_token,
                'statusCode' => 200,
            );

            $response = new WP_REST_Response($registeredAccountResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
                } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function activate(WP_REST_Request $request)
    {
        try {
            (new Account($request['email']))->activate($request['user_activation_key']);

            $accountActivatedResponse = [
                'successMessage' => 'Your account has been activated.',
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($accountActivatedResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
                } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function lock(WP_REST_Request $request)
    {
        try {
            $accessToken = $this->token->getAccessToken($request);
            $refreshToken = $this->token->getRefreshToken($request);

            $auth = new Authenticated($accessToken, $refreshToken);

            $lockedAccount = (new Account($auth->email))->lock();

            $lockedAccountResponse = [
                'successMessage' => $lockedAccount,
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($lockedAccountResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function unlock(WP_REST_Request $request)
    {
        try {
            $unlockedAccount = (new Account($request['email']))->unlock($request['user_activation_key']);

            $unlockAccountResponse = [
                'successMessage' => $unlockedAccount,
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($unlockAccountResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function recover(WP_REST_Request $request)
    {
        try {
            $recoverAccount = (new Account($request['email']))->recover($request['user_activation_key']);

            $recoverAccountResponse = [
                'successMessage' => $recoverAccount,
                'statusCode' => 200
            ];

            $response = new WP_REST_Response($recoverAccountResponse);
            $response->set_status(200);

            return rest_ensure_response($response);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
