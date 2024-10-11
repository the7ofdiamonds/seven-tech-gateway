<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Change\Change;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Change
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

            $updateUsernameResponse = [
                'successMessage' => (new Change($request['email']))->username($request['username']),
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

            $firstName = $request['first_name'];
            $lastName = $request['last_name'];
            
            if (!empty($firstName)) {
                (new Change($request['email']))->firstName($firstName);
            }

            if (!empty($lastName)) {
                (new Change($request['email']))->lastName($lastName);
            }

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

    function changeNicename(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $changeNickNameResponse = [
                'successMessage' => (new Change($request['email']))->nicename($request['nicename']),
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

    function changeNickname(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $changeNickNameResponse = [
                'successMessage' => (new Change($request['email']))->nickname($request['nickName']),
                'nickname' => $request['nickName'],
                'statusCode' => 200
            ];

            return rest_ensure_response($changeNickNameResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function changePhone(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $changePhoneResponse = [
                'successMessage' => (new Change($request['email']))->phone('+' . $request['phone']),
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
