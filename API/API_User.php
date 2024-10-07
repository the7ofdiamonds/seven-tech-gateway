<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\User\User;
use SEVEN_TECH\Gateway\User\Add;

use Exception;

use WP_REST_Request;

class API_User
{
    private $create;
    private $authorization;

    public function __construct()
    {
        $this->authorization = new Authorization;
    }

    function add(WP_REST_Request $request)
    {
        try {
            $signupResponse = (new Add)->user($request['email'], $request['username'], $request['password'], $request['nicename'], $request['phone']);

            return rest_ensure_response($signupResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function get(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            return rest_ensure_response((new User($request['email'])));
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }


    public function addUserRole(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $addUserRoleResponse = [
                'successMessage' => (new Roles)->addRole($authorized->id, $request['name'], $request['display_name']),
                'roles' => (new User($authorized->email))->roles,
                'statusCode' => 200
            ];

            return rest_ensure_response($addUserRoleResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    public function removeUserRole(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $removeUserRoleResponse = [
                'successMessage' => (new Roles)->removeRole($authorized->id, $request['name'], $request['display_name']),
                'roles' => (new User($authorized->email))->roles,
                'statusCode' => 200
            ];

            return rest_ensure_response($removeUserRoleResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

}
