<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Signup
{

    private $auth;

    public function __construct($auth)
    {
        $this->auth = $auth;
    }
    
    public function signup(WP_REST_Request $request)
    {
        try {

            $user_login = $request['user_login'];
            $user_email = $request['user_email'];
            $user_password = $request['user_password'];

            $hashedPassword = password_hash($user_password, PASSWORD_BCRYPT);

            $userLogin = get_user_by('login', $user_login);

            if ($userLogin) {
                return rest_ensure_response("A user already exists with this user name. Choose another user name.");
            }
            
            $userEmail = get_user_by('email', $user_email);

            if ($userEmail) {
                return rest_ensure_response("A user already exists with this email. Please go to the forgot page to reset your password.");
            }

            $user_data = array(
                'user_login' => $user_login,
                'user_pass'  => $hashedPassword, // Note: This should be a hashed password, not plain text
                'user_email' => $user_email,
                'first_name' => 'John',
                'last_name'  => 'Doe',
                'role'       => 'user', // Set the user role (e.g., subscriber, author, editor, administrator)
            );
            
            // Insert the new user
            wp_insert_user($user_data);

            $credentials = [
                'user_login' => $user_login,
                'user_password' => $user_password,
                'remember' => true
            ];

            $signedInUser = wp_signon($credentials);

            if (is_wp_error($signedInUser)) {
                $message = [
                    'message' => $signedInUser->get_error_message(),
                ];
                $response = rest_ensure_response($message);
                $response->set_status(401);

                return $response;
            }

            wp_set_current_user($signedInUser->ID, $signedInUser->user_login);
            wp_set_auth_cookie($signedInUser->ID, true);

            if (is_user_logged_in()) {
                return rest_ensure_response('You have logged in successfully as ' . $user_login . ' using the email ' . $user_email);
            }
        } catch (Exception $e) {
            $error_message = $e->getMessage();
            $status_code = $e->getCode();

            $response_data = [
                'message' => $error_message,
                'status' => $status_code
            ];

            $response = rest_ensure_response($response_data);
            $response->set_status($status_code);

            return $response;
        }
    }
}
