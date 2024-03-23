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

            $headers = $request->get_headers();

            error_log(print_r($location, true));

            $authentication = $headers['authentication'][0];
            $idToken = substr($authentication, 7);
            $verifiedIdToken = $this->auth->verifyIdToken($idToken);
            $email = $verifiedIdToken->claims()->get('email');

            global $wpdb;

            $storedProcedureName = 'findUserByEmail';

            $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $email));

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if ($results == null) {
               $tokenResponse = [
                    'errorMessage' => 'This username could not be found',
                ];

                $response = rest_ensure_response($tokenResponse);
                $response->set_status(404);

                return $response;
            }

            $userData = $results[0];

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
}
