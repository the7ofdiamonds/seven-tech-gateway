<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authenticated;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Change\Change as ChangeClass;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

class Change
{
    private $authorization;

    public function __construct()
    {
        $this->authorization = new Authorization;
    }

    function username(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            (new ChangeClass($auth->email))->username($request['username']);

            $updateUsernameResponse = [
                'successMessage' => "Your username has been changed to {$request['username']}.",
                'username' => $request['username'],
                'statusCode' => 200
            ];

            return rest_ensure_response($updateUsernameResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function name(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            $firstName = $request['first_name'];
            $lastName = $request['last_name'];

            (new ChangeClass($auth->email))->name($firstName, $lastName);

            $responseNameChanged = [
                'successMessage' => "Your name has been changed to {$firstName} {$lastName} succesfully.",
                'firstName' => $firstName,
                'lastName' => $lastName,
                'statusCode' => 200
            ];


            return rest_ensure_response($responseNameChanged);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function nicename(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            (new ChangeClass($auth->email))->nicename($request['nicename']);

            $changeNickNameResponse = [
                'successMessage' => "Your nicename has been changed to {$request['nicename']}.",
                'nicename' => $request['nicename'],
                'statusCode' => 200
            ];

            return rest_ensure_response($changeNickNameResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function nickname(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            (new ChangeClass($auth->email))->nickname($request['nickname']);

            $changeNickNameResponse = [
                'successMessage' => "Your nickname has been been changed to {$request['nickname']}.",
                'nickname' => $request['nickname'],
                'statusCode' => 200
            ];

            return rest_ensure_response($changeNickNameResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function phone(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $tokens = (new Token)->getTokens($request);
            $auth = new Authenticated($tokens['access_token'], $tokens['Refresh-Token']);

            if (empty($auth->email)) {
                throw new Exception('An email is required to change password.', 400);
            }

            (new ChangeClass($auth->email))->phone("+{$request['phone']}");

            $changePhoneResponse = [
                'successMessage' => "Your phone number has been changed to {$request['phone']}.",
                'phone' => '+' . $request['phone'],
                'statusCode' => 200
            ];

            return rest_ensure_response($changePhoneResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
