<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\Create;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Account
{

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
            $lockedAccount = (new Account($request['email']))->lock($request['confirmationCode']);

            return rest_ensure_response($lockedAccount);
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

            return rest_ensure_response($unlockedAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function disable(WP_REST_Request $request) {
        try {
            $disabledAccount = (new Account($request['email']))->disable($request['confirmationCode']);

            return rest_ensure_response($disabledAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function enable(WP_REST_Request $request)
    {
        try {
            $enabledAccount = (new Account($request['email']))->enable($request['confirmationCode']);

            return rest_ensure_response($enabledAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
