<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Create;
use SEVEN_TECH\Gateway\Authentication\Authenticated;
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
            $authenticatedAccount = (new Create)->account($request['email'], $request['username'], $request['password'], $request['confirmPassword'], $request['nicename'], $request['nickname'], $request['firstname'], $request['lastname'], $request['phone']);

            return rest_ensure_response($authenticatedAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function activate(WP_REST_Request $request)
    {
        try {
            $accountActivated = (new Account($request['email']))->activate($request['userActivationCode']);

            return rest_ensure_response($accountActivated);
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
            $unlockedAccount = (new Account($request['email']))->unlock($request['confirmationCode']);

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
}
