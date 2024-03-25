<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

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
                $tokenResponse = [
                    'errorMessage' => 'You could not be logged in successfully',
                ];

                $response = rest_ensure_response($tokenResponse);
                $response->set_status(400);
                return $response;
            }

            $tokenResponse = [
                'successMessage' => 'You have been logged in successfully'
            ];

            $response = rest_ensure_response($tokenResponse);
            $response->set_status(200);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at loging in using the tokens provided.');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }

    function getToken(WP_REST_Request $request)
    {
        try {
            $headers = $request->get_headers();
            $authentication = $headers['authentication'][0];
            $idToken = substr($authentication, 7);

            return $this->auth->verifyIdToken($idToken);
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
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
