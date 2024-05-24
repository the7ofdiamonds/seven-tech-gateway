<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\User\User;

use Exception;

use WP_REST_Request;

class API_User
{
    private $authorization;
    private $user;
    private $authentication;

    public function __construct(User $user, Authentication $authentication, Authorization $authorization)
    {
        $this->user = $user;
        $this->authentication = $authentication;
        $this->authorization = $authorization;
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
            $role = '';
            $activationCode = '';

            $this->user->addUser($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $role, $activationCode);

            $signupResponse = [
                'successMessage' => $this->authentication->login($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($signupResponse);
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

            $getUserResponse = [
                'user' => $this->user->getUser($email),
                'statusCode' => 200
            ];

            return rest_ensure_response($getUserResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function changeUsername(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            if (!isset($request['email'])) {
                throw new Exception('Email is required.', 400);
            }

            if (!isset($request['username'])) {
                throw new Exception('Username is required.', 400);
            }

            $email = $request['email'];
            $username = $request['username'];

            $updateUsernameResponse = [
                'successMessage' => $this->user->changeUsername($email, $username),
                'username' => $username,
                'statusCode' => 200
            ];

            return rest_ensure_response($updateUsernameResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function changeName(WP_REST_Request $request)
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
            $firstname = '';
            $lastname = '';

            if (isset($request['first_name'])) {
                $firstname = $request['first_name'];
            }

            if (isset($request['last_name'])) {
                $lastname = $request['last_name'];
            }

            if ($firstname != '' && $lastname != '') {
                $this->user->changeFirstName($email, $firstname);

                $this->user->changeLastName($email, $lastname);

                $changeNameResponse = [
                    'successMessage' => "Your name has been changed to {$firstname} {$lastname} succesfully.",
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'statusCode' => 200
                ];

                return rest_ensure_response($changeNameResponse);
            }

            if ($firstname != '') {
                $changeNameResponse = [
                    'successMessage' => $this->user->changeFirstName($email, $firstname),
                    'firstname' => $firstname,
                    'statusCode' => 200
                ];

                return rest_ensure_response($changeNameResponse);
            }

            if ($lastname != '') {
                $changeNameResponse = [
                    'successMessage' => $this->user->changeLastName($email, $lastname),
                    'lastname' => $lastname,
                    'statusCode' => 200
                ];

                return rest_ensure_response($changeNameResponse);
            }
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

            if (!isset($request['email'])) {
                throw new Exception('Email is required.', 400);
            }

            if (!isset($request['nickname'])) {
                throw new Exception('Nick name is required.', 400);
            }

            $email = $request['email'];
            $nickname = $request['nickName'];

            $changeNickNameResponse = [
                'successMessage' => $this->user->changeNickname($email, $nickname),
                'nickname' => $nickname,
                'statusCode' => 200
            ];

            return rest_ensure_response($changeNickNameResponse);
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

            if (!isset($request['email'])) {
                throw new Exception('Email is required.', 400);
            }

            if (!isset($request['nicename'])) {
                throw new Exception('Nice name is required.', 400);
            }

            $email = $request['email'];
            $nicename = $request['nicename'];

            $changeNickNameResponse = [
                'successMessage' => $this->user->changeNicename($email, $nicename),
                'nicename' => $nicename,
                'statusCode' => 200
            ];

            return rest_ensure_response($changeNickNameResponse);
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
                'successMessage' => $this->user->addUserRole($authorized->id, $request['role_name'], $request['role_display_name']),
                'statusCode' => 200
            ];

            return rest_ensure_response($addUserRoleResponse);
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
                'successMessage' => $this->user->removeUserRole($authorized->id, $request['role_name'], $request['role_display_name']),
                'statusCode' => 200
            ];

            return rest_ensure_response($removeUserRoleResponse);
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

            if (!isset($request['email'])) {
                throw new Exception('Email is required.', 400);
            }

            if (!isset($request['phone'])) {
                throw new Exception('Phone is required.', 400);
            }

            $email = $request['email'];
            $phone = '+' . $request['phone'];

            $changePhoneResponse = [
                'successMessage' => $this->user->changePhone($email, $phone),
                'phone' => $phone,
                'statusCode' => 200
            ];

            return rest_ensure_response($changePhoneResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
