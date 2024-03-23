<?php

namespace SEVEN_TECH\Admin;

use Exception;

class AdminAccountManagement
{
    function forgotPassword()
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at forgot password.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function lockAccount()
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at lock account.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function unlockAccount()
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at unlock account.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function removeAccount()
    {
        try {
        } catch (Exception $e) {
            error_log('There has been an error at remove account.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function deleteAccount($email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                "CALL deleteAccount('$email')"
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            $results = $results[0]->result;

            if (!$results) {
                $deleteAccountResponse = [
                    'errorMessage' => 'Account could not be deleted at this time.',
                ];

                $response = rest_ensure_response($deleteAccountResponse);
                $response->set_status(400);

                return $response;
            }

            $deleteAccountResponse = [
                'successMessage' => 'Account deleted succesfully.',
            ];

            return rest_ensure_response($deleteAccountResponse);
        } catch (Exception $e) {
            error_log('There has been an error at delete account.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
