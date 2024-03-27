<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Admin\AdminAccountManagement;

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Account
{
    private $adminaccountmngmnt;

    public function __construct()
    {
        $this->adminaccountmngmnt = new AdminAccountManagement;
    }

    function unlockAccount(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];

            $this->adminaccountmngmnt->unlockAccount($username, $password, $confirmationCode);
        } catch (Exception $e) {
            error_log('There has been an error at unlock account');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function removeAccount(WP_REST_Request $request)
    {
        try {
            $username = $request['username'];
            $password = $request['password'];
            $confirmationCode = $request['confirmationCode'];

            $this->adminaccountmngmnt->removeAccount($username, $password, $confirmationCode);
        } catch (FailedToVerifyToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at remove account');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
