<?php

namespace THFW_Users\API;

class Logout
{
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('thfw/users/v1', '/logout', array(
                'methods' => 'POST',
                'callback' => array($this, 'logout'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    public function logout()
    {
        wp_logout();

        if (!is_user_logged_in()) {
            $response = rest_ensure_response('You have been logged out');
            $response->set_status(200);
            return $response;
        } else {
            $messsage = [
                'message' => 'Logout failed'
            ];
            $response = rest_ensure_response($messsage);
            $response->set_status(400);
            return $response;
        }
    }
}
