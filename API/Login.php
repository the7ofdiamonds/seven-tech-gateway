<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Auth;

class Login
{

    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    function login(WP_REST_Request $request)
    {
        try {
            $display_name = $request['username'];
            $email = $request['email'];
            $password = $request['password'];
            $location = $request['location'];
            error_log(print_r($location, true));

            if (empty($display_name) && empty($email)) {
                $statusCode = 400;
                $loginResponse = [
                    'errorMessage' => 'A Username or email is required for login',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status($statusCode);

                return $response;
            }

            if (empty($password)) {
                $statusCode = 400;
                $loginResponse = [
                    'errorMessage' => 'A Password is required for login',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status($statusCode);

                return $response;
            }

            global $wpdb;

            if (!empty($display_name)) {
                $storedProcedureName = 'findUserByUsername';

                $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $display_name));

                if ($wpdb->last_error) {
                    error_log("Error executing stored procedure: " . $wpdb->last_error);
                }

                if ($results == null) {
                    $statusCode = 404;
                    $loginResponse = [
                        'errorMessage' => 'This username could not be found',
                        'statusCode' => $statusCode
                    ];

                    $response = rest_ensure_response($loginResponse);
                    $response->set_status($statusCode);

                    return $response;
                }
            }

            if (!empty($email)) {
                $storedProcedureName = 'findUserByEmail';

                $results = $wpdb->get_results($wpdb->prepare("CALL $storedProcedureName(%s)", $email));

                if ($wpdb->last_error) {
                    error_log("Error executing stored procedure: " . $wpdb->last_error);
                }

                if ($results == null) {
                    $statusCode = 404;
                    $loginResponse = [
                        'errorMessage' => 'This email could not be found',
                        'statusCode' => $statusCode
                    ];

                    $response = rest_ensure_response($loginResponse);
                    $response->set_status($statusCode);

                    return $response;
                }
            }

            $userData = $results[0];

            $password_check = wp_check_password($password, $userData->password, $userData->id);

            if (!$password_check) {
                $statusCode = 404;
                $loginResponse = [
                    'errorMessage' => 'The password you entered for this username is not correct.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $credentials = array(
                'user_login'    => $userData->email,
                'user_password' => $password,
                'remember'      => true,
            );

            $user = wp_signon($credentials, false);

            if (is_wp_error($user)) {
                $statusCode = 404;
                $loginResponse = [
                    'errorMessage' => $user->get_error_message(),
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status($statusCode);

                return $response;
            }

            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);

            if (!is_user_logged_in()) {
                $statusCode = 400;
                $loginResponse = [
                    'errorMessage' => 'You could not be logged in successfully',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($loginResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $signedInUser = $this->auth->signInWithEmailAndPassword($userData->email, $password);
            $accessToken = $signedInUser->idToken();
            $refreshToken = $signedInUser->refreshToken();

            $statusCode = 200;
            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken,
                'email' => $userData->email,
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($loginResponse);
            $response->set_status($statusCode);

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
