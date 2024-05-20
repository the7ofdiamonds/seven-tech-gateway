<?php

namespace SEVEN_TECH\Gateway\API;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Authorization\Authorization;
use SEVEN_TECH\Gateway\Token\Token;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class API_Account
{
    private $account;
    private $authentication;
    private $authorization;

    public function __construct(Auth $auth, Token $token)
    {
        $this->account = new Account;
        $this->authentication = new Authentication($auth);
        $this->authorization = new Authorization($token);
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
$roles = '';

            $createdAccount = $this->account->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            
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
            $verifiedCredentials = $this->authorization->verifyCredentials($request);

            if (!$verifiedCredentials) {
                throw new Exception('Unauthorized credentials could not be verified.', 403);
            }

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
            $verifiedCredentials = $this->authorization->verifyCredentials($request);

            if (!$verifiedCredentials) {
                throw new Exception('Unauthorized credentials could not be verified.', 403);
            }

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
// disable account happens after a certain time 
    function enableAccount(WP_REST_Request $request)
    {
        try {
            $verifiedCredentials = $this->authorization->verifyCredentials($request);

            if (!$verifiedCredentials) {
                throw new Exception('Unauthorized credentials could not be verified.', 403);
            }

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
