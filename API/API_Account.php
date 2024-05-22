<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

use WP_REST_Request;

class API_Account
{
    private $account;
    private $authentication;
    private $authorization;

    public function __construct(Account $account, Authentication $authentication, Authorization $authorization)
    {
        $this->account = $account;
        $this->authentication = $authentication;
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

            $this->account->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            $signupResponse = array(
                'successMessage' => 'You have been signed up successfully.',
                'statusCode' => 201,
                'login' => $this->authentication->login($request)
            );

            return rest_ensure_response($signupResponse);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function lockAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $lockedAccount = $this->account->lockAccount($request['email']);

            return rest_ensure_response($lockedAccount);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $unlockedAccount = $this->account->unlockAccount($request['email']);

            return rest_ensure_response($unlockedAccount);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }

    function enableAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $enabledAccount = $this->account->enableAccount($request['email']);

            return rest_ensure_response($enabledAccount);
        } catch (Exception $e) {
            return (new DestructuredException($e))->rest_ensure_response_error();
        }
    }
}
