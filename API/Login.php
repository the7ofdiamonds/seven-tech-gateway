<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Login
{

    private $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $display_name = $request['username'];
            $password = $request['password'];
            $location = $request['location'];
            error_log(print_r($location, true));

            if (empty($display_name)) {
                return rest_ensure_response('A Username or email is required for login');
            }

            if (empty($password)) {
                return rest_ensure_response('A Password is required for login');
            }

            global $wpdb;

            $storedProcedureName = 'findUserByUsername';

            $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $display_name));

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
            }

            if ($results == null) {
                $loginResponse = [
                    'message_type' => 'error',
                    'message' => 'This username could not be found',
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status(404);

                return $response;
            }

            $userData = $results[0];

            $password_check = wp_check_password($password, $userData->password, $userData->id);

            if (!$password_check) {
                $loginResponse = [
                    'message_type' => 'error',
                    'message' => 'The password you entered for this username is not correct.',
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status(404);

                return $response;
            }

            $email = $userData->email;

            $credentials = array(
                'user_login'    => $userData->email,
                'user_password' => $password,
                'remember'      => true,
            );

            $user = wp_signon($credentials, false);

            if (is_wp_error($user)) {
                $loginResponse = [
                    'message_type' => 'error',
                    'message' => $user->get_error_message(),
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status(404);

                return $response;
            }

            $firebaseUser = $this->auth->getUserByEmail($email);

            $claims = [];
            $oneWeek = new \DateInterval('P7D');

            $createCustomToken = $this->auth->createCustomToken($firebaseUser->uid);
            $customToken = $createCustomToken->toString();

            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);

            if (!is_user_logged_in()) {
                $loginResponse = [
                    'message_type' => 'error',
                    'message' => 'You could not be logged in successfully',
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status(400);
                error_log('User could not be logged');
            }

            $loginResponse = [
                'message_type' => 'success',
                'message' => 'You have been logged in successfully',
                'custom_token' => $customToken,
                'username' => $display_name
            ];

            $response = rest_ensure_response($loginResponse);
            $response->set_status(200);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at login');
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
