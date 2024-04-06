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

// Send password needs to be updated email
    function login(WP_REST_Request $request)
    {
        try {
            $email = $request['email'];
            $password = $request['password'];
            $location = $request['location'];
            error_log(print_r($location, true));

            if (empty($email)) {
                $statusCode = 400;
                throw new Exception('An email is required for login.', $statusCode);
            }

            if (empty($password)) {
                $statusCode = 400;
                throw new Exception('A Password is required for login', $statusCode);
            }

            global $wpdb;

            $results = $wpdb->get_results($wpdb->prepare("CALL findUserByEmail(%s)", $email));

            if ($wpdb->last_error) {
                $statusCode = 500;
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, $statusCode);
            }

            $user = $results[0];

            if ($user == null) {
                $statusCode = 404;
                throw new Exception('This email could not be found', $statusCode);
            }

            $password_check = wp_check_password($password, $user->password, $user->id);

            if (!$password_check) {
                $statusCode = 404;
                throw new Exception('The password you entered for this username is not correct.', $statusCode);
            }

            $credentials = array(
                'user_login'    => $user->email,
                'user_password' => $password,
                'remember'      => true,
            );

            $user = wp_signon($credentials, false);

            if (is_wp_error($user)) {
                throw new Exception($user->get_error_message(), $user->get_error_code());
            }

            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID, true);

            if (!is_user_logged_in()) {
                $statusCode = 400;
                throw new Exception('You could not be logged in successfully', $statusCode);
            }

            $signedInUser = $this->auth->signInWithEmailAndPassword($user->email, $password);
            $accessToken = $signedInUser->idToken();
            $refreshToken = $signedInUser->refreshToken();

            $statusCode = 200;
            $loginResponse = [
                'successMessage' => 'You have been logged in successfully',
                'accessToken' => $accessToken,
                'refreshToken' => $refreshToken,
                'email' => $user->email,
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($loginResponse);
            $response->set_status($statusCode);

            return $response;
        } catch (Exception $e) {
            error_log('There has been an error at login');
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
