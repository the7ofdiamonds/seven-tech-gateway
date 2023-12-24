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
            $idToken = $request['idToken'];
            $user_password = $request['user_password'];

            if (empty($idToken)) {
                throw new Exception('Token is required.');
            }

            $verifiedIdToken = $this->auth->verifyIdToken($idToken);

            $uid = $verifiedIdToken->claims()->get('sub');
            $user = $this->auth->getUser($uid);
            $email = $user->email;

            $userData = get_user_by('email', $email);

            if (!$userData) {
                throw new Exception('User not found');
            }

            $user_login = $userData->user_login;

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
                return rest_ensure_response('You have been logged in successfully using the email ' . $email);
            }
        } catch (Exception $e) {
            $message = [
                'message' => $e->getMessage(),
            ];
            $response = rest_ensure_response($message);
            $response->set_status($e->getCode());
            return $response;
        }
    }
}
