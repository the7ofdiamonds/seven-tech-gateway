<?php

namespace SEVEN_TECH\API;

class Team
{
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('thfw/users/v1', '/team', array(
                'methods' => 'GET',
                'callback' => array($this, 'get_team'),
                'permission_callback' => '__return_true',
            ));
        });
    }

    function get_team()
    {
        $team = [];
        $users = get_users(array(
            'role__in' => array(
                'founder/managing member',
            )
        ));

        if (!empty($users)) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);

                $team_member = array(
                    'id' => $user_data->ID,
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'email' => $user_data->user_email,
                    'role' => $user_data->roles,
                    'author_url' => $user_data->user_url,
                    'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                );

                $team[] = $team_member;
            }

            return $team;
        } else {
            echo "No users found.";
        }
    }
}
