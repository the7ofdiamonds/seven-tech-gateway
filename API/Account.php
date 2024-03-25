<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use SEVEN_TECH\Admin\AdminAccountManagement;

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
