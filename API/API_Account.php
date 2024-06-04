<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Account\AccountCreate;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authentication\AuthenticationLogin;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Account
{
    private $createAccount;
    private $login;
    private $authorization;

    public function __construct(AccountCreate $createAccount, AuthenticationLogin $login, Authorization $authorization)
    {
        $this->createAccount = $createAccount;
        $this->login = $login;
        $this->authorization = $authorization;
    }

    function createAccount(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $username = $request['username'];
            $password = $request['password'];
            $nicename = $request['nicename'];
            $nickname = $request['nickname'];
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $phone = $request['phone'];
            $roles = 'subscriber';

            $this->createAccount->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            $signupResponse = array(
                'successMessage' => 'You have been signed up successfully.',
                'statusCode' => 201,
                'login' => $this->login->signInWithEmailAndPassword($email, $password)
            );

            return rest_ensure_response($signupResponse);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function lockAccount(WP_REST_Request $request)
    {
        try {
            $authorized = $this->authorization->isAuthorized($request);

            if (!$authorized) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $lockedAccount = (new Account($request['email']))->lockAccount($request['confirmationCode']);

            return rest_ensure_response($lockedAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            if (!isset($request['email'])) {
                throw new Exception('An email is required.', 400);
            }

            if (!isset($request['confirmationCode'])) {
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];

            $verified = (new Authentication($email))->verifyCredentials($confirmationCode);

            if (!$verified) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $unlockedAccount = (new Account($request['email']))->unlockAccount($request['confirmationCode']);

            return rest_ensure_response($unlockedAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function enableAccount(WP_REST_Request $request)
    {
        try {
            if (!isset($request['email'])) {
                throw new Exception('An email is required.', 400);
            }

            if (!isset($request['confirmationCode'])) {
                throw new Exception('A Confirmation Code is required to verify your email. Check your inbox.', 400);
            }

            $email = $request['email'];
            $confirmationCode = $request['confirmationCode'];

            $verified = (new Authentication($email))->verifyCredentials($confirmationCode);

            if (!$verified) {
                throw new Exception('You do not have permission to perform this action', 403);
            }

            $enabledAccount = (new Account($request['email']))->enableAccount($request['confirmationCode']);

            return rest_ensure_response($enabledAccount);
        } catch (DestructuredException $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
