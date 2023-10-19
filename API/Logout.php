<?php

namespace SEVEN_TECH\API;

use Exception;

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
        try {
            // wp_logout();

            if (!is_user_logged_in()) {
                $response = rest_ensure_response('You have been logged out');
                $response->set_status(200);
                return $response;
            } else {
                throw new Exception('User could not be logged out.');
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
