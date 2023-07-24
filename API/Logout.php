<?php

namespace THFW_Users\API;

use WP_REST_Request;
use WP_Error;

class Logout
{
    private $auth;

    public function __construct($factory)
    {
        $this->auth = $factory->createAuth();

        add_action('rest_api_init', function () {
            register_rest_route('thfw/users/v1', '/logout', array(
                'methods' => 'POST',
                'callback' => array($this, 'logout'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function logout(WP_REST_Request $request)
    {
        $this->auth->logout;
        wp_logout();
        $_SESSION['idToken'] = '';

        if (!is_user_logged_in()) {
            return rest_ensure_response('You have been logged out');
        }
    }
}
