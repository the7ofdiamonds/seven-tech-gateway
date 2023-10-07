<?php

namespace THFW_Users\API;

class Users
{
    public function __construct()
    {
        // add_action('rest_api_init', function () {
        //     register_rest_route('thfw/users/v1', '/team', array(
        //         'methods' => 'GET',
        //         'callback' => array($this, 'get_team'),
        //         'permission_callback' => '__return_true',
        //     ));
        // });
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
