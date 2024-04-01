<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

use Kreait\Firebase\Contract\Auth;

class Signup
{
    private $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    public function signup(WP_REST_Request $request)
    {
        try {
            $displayName = $request['username'];
            $user_email = $request['email'];
            $user_password = $request['password'];
            $hashedPassword = password_hash($user_password, PASSWORD_BCRYPT);
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $phone = $request['phone'];

            $userLogin = get_user_by('login', $displayName);

            if ($userLogin) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'A user already exists with this user name. Choose another user name.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $userEmail = get_user_by('email', $user_email);

            if ($userEmail) {
                $statusCode = 400;
                $signupResponse = [
                    'errorMessage' => 'A user already exists with this email. Please go to the forgot page to reset your password.',
                    'statusCode' => $statusCode
                ];

                $response = rest_ensure_response($signupResponse);
                $response->set_status($statusCode);

                return $response;
            }

            $user_data = array(
                'user_login' => $displayName,
                'user_pass'  => $hashedPassword,
                'user_email' => $user_email,
                'first_name' => $firstname,
                'last_name'  => $lastname,
                'role'       => 'subscriber'
            );

            wp_insert_user($user_data);

            $credentials = [
                'user_login' => $user_email,
                'user_password' => $hashedPassword,
                'remember' => true
            ];

            $signedInUser = wp_signon($credentials);

            if (is_wp_error($signedInUser)) {
                $statusCode = 400;
                $message = [
                    'errorMessage' => $signedInUser->get_error_message(),
                    'statusCode' => $statusCode
                ];
                $response = rest_ensure_response($message);
                $response->set_status($statusCode);

                return $response;
            }

            wp_set_current_user($signedInUser->ID, $signedInUser->user_login);
            wp_set_auth_cookie($signedInUser->ID, true);

            if (!is_user_logged_in()) {
                throw new Exception("there was an error signing up a new user.");
            }

            $newUser = [
                'email' => $user_email,
                'emailVerified' => false,
                'phoneNumber' => '+' . $phone,
                'password' => $user_password,
                'displayName' => $displayName,
                'photoUrl' => '',
                'disabled' => false,
            ];

            $newFirebaseUser = $this->auth->createUser($newUser);

            if (!$newFirebaseUser) {
                error_log("Unable to add user with email {$user_email} to firebase.");
            }

            $statusCode = 201;
            $signupResponse = [
                'successMessage' => 'You have logged in successfully as ' . $displayName . ' using the email ' . $user_email . '.',
                'statusCode' => $statusCode
            ];

            $response = rest_ensure_response($signupResponse);
            $response->set_status($statusCode);

            return $response;
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
