<?php

namespace SEVEN_TECH\API;

use Exception;

use WP_REST_Request;

class Users
{
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('seven-tech/v1', '/users/(?P<slug>[a-zA-Z0-9-_%.]+)', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_user'),
                'permission_callback' => '__return_true',
            ));
        });

        // add_action('rest_api_init', function () {
        //     register_rest_route('thfw/users/v1', '/team', array(
        //         'methods' => 'GET',
        //         'callback' => array($this, 'get_team'),
        //         'permission_callback' => '__return_true',
        //     ));
        // });
    }

    public function get_user(WP_REST_Request $request)
    {
        try {
            $user_email_encoded = $request->get_param('slug');
            $user_email = urldecode($user_email_encoded);
            $user = get_user_by('email', $user_email);
            $user_id = $user->id;

            return rest_ensure_response($user_id);
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

    function get_team()
    {
        $team = get_users(array(
            'role__in' => array(
                'author',
                'shop manager',
                'editor',
                'founder/managing member',
                'Administrator'
            )
        ));
return $team;
        if ($team) {
            foreach ($team as $member) {
            }
        }
    }
}
