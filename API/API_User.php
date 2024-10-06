<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\AuthenticationLogin;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\User\User;
use SEVEN_TECH\Gateway\User\UserCreate;

use Exception;

use WP_REST_Request;

class API_User
{
    private $createUser;
    private $login;
    private $authorization;

    public function __construct()
    {
        $this->createUser = new UserCreate;
        $this->login = new AuthenticationLogin;
        $this->authorization = new Authorization;
    }

    function addUser(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $email = $request['email'];
            $password = $request['password'];
            $nicename = $request['nicename'];
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $nickname = $request['nickname'];
            $phone = $request['phone'];
           
            $this->createUser->createUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone);

            $signupResponse = [
                'successMessage' => $this->login->signInWithEmailAndPassword($email, $password),
                'statusCode' => 200
            ];

            return rest_ensure_response($signupResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function getUser(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            if (!isset($request['email'])) {
                throw new Exception('Email is required.', 400);
            }

            $email = $request['email'];

            $user = (new User($email));

            return rest_ensure_response($user);
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
