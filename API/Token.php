<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Exception\AppCheck\FailedToVerifyAppCheckToken;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class Token
{
    private $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    function token(WP_REST_Request $request)
    {
        try {
            $location = $request['location'];

            error_log(print_r($location, true));

            $verifiedIdToken = $this->getToken($request);

            $userData = $this->findUserWithToken($verifiedIdToken);

            wp_set_current_user($userData->id);
            wp_set_auth_cookie($userData->id, true);

            if (!is_user_logged_in()) {
                $statusCode = 400;
                $tokenResponse = [
                    'errorMessage' => 'You could not be logged in successfully',
                ];

                $response = rest_ensure_response($tokenResponse);
                $response->set_status($statusCode);
                return $response;
            }

            $statusCode = 200;
            $tokenResponse = [
                'successMessage' => 'You have been logged in successfully',
                "statusCode" => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (FailedToVerifyAppCheckToken $e) {
            $statusCode = 403;
            $tokenResponse = [
                'message' => $e->getMessage(),
                'errorMessage' => "Please login to gain access and permission.",
                "statusCode" => $statusCode
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at loging in using the tokens provided.');
            $statusCode = $e->getCode();
            $message = [
                'message' => $e->getMessage(),
                'statusCode' => $statusCode
            ];
            $response = rest_ensure_response($message);
            $response->set_status($statusCode);
            return $response;
        }
    }

    function getToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();
            $authentication = $headers['authorization'][0];
            $idToken = substr($authentication, 7);

            return $this->auth->verifyIdToken($idToken);
        } catch (FailedToVerifyToken $e) {
            throw new FailedToVerifyToken($e);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function findUserWithToken($token)
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token);
            $email = $verifiedIdToken->claims()->get('email');

            global $wpdb;

            $storedProcedureName = 'findUserByEmail';

            $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $email));

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if ($results == null) {
                throw new Exception('This username could not be found');
            }

            return $results[0];
        } catch (FailedToVerifyToken $e) {
            throw new FailedToVerifyToken($e);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
