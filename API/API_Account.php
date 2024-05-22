<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authorization\Authorization;

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
            $roles = $request['roles'];

            $this->account->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            $signupResponse = [
                'successMessage' => $this->authentication->login($request),
                'statusCode' => 200
            ];

            return rest_ensure_response($signupResponse);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function lockAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $lockedAccount = $this->account->lockAccount($request['email']);

            return rest_ensure_response($lockedAccount);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $unlockedAccount = $this->account->unlockAccount($request['email']);

            return rest_ensure_response($unlockedAccount);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }

    function enableAccount(WP_REST_Request $request)
    {
        try {
            $this->authorization->verifyCredentials($request);

            $enabledAccount = $this->account->enableAccount($request['email']);

            return rest_ensure_response($enabledAccount);
        } catch (Exception $e) {
            $statusCode = $e->getCode();
            $response_data = [
                'errorMessage' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($response_data);
            $response->set_status($statusCode);

            return $response;
        }
    }
}
