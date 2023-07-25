<?php

namespace THFW_Users\API;

use WP_REST_Request;
use WP_Error;

use Kreait\Firebase\Exception\AuthException;

class Signup
{
    private $auth;

    public function __construct($factory)
    {
        $this->auth = $factory->createAuth();

        add_action('rest_api_init', function () {
            register_rest_route('thfw/users/v1', '/signup', array(
                'methods' => 'POST',
                'callback' => array($this, 'signup'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function signup(WP_REST_Request $request)
    {
        $user_login = $request['user_login'];
        $user_email = $request['user_email'];
        $user_password = $request['user_password'];

        $userLogin = get_user_by('login', $user_login);

        if($userLogin){
            return rest_ensure_response("A user already exists with this user name. Choose another user name.");
        }
        try {
            wp_create_user($user_login,  $user_password, $user_email);
        } catch (WP_Error $e) {
            return rest_ensure_response($e);
        }
        
        $userEmail = get_user_by('email', $user_email);

        if ($userEmail) {
            return rest_ensure_response("A user already exists with this email. Please go to the forgot page to reset your password.");
        }

        $credentials = [
            'user_login' => $user_login,
            'user_password' => $user_password,
            'remember' => true
        ];

        $signedInUser = wp_signon($credentials);

        if (is_wp_error($signedInUser)) {
            return new WP_Error('login_failed', $signedInUser->get_error_message(), array('status' => 401));
        }

        wp_set_current_user($signedInUser->ID, $signedInUser->user_login);
        wp_set_auth_cookie($signedInUser->ID, true);

        if (is_user_logged_in()) {
            return rest_ensure_response('You have logged in successfully as ' . $user_login . ' using the email ' . $user_email);
        }
    }
}
