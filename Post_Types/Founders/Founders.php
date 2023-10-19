<?php

namespace SEVEN_TECH\Post_Types\Founders;

use Exception;

class Founders
{
    public function __construct()
    {
    }

    function getFounders()
    {
        $founders = [];
        $users = get_users(array(
            'role__in' => array(
                'founder'
            )
        ));

        if ($users) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);

                $founder = array(
                    'id' => $user_data->ID,
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'email' => $user_data->user_email,
                    'role' => $user_data->roles,
                    'author_url' => $user_data->user_url,
                    'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                );

                $founders[] = $founder;
            }

            return $founders;
        } else {
            throw new Exception("No Founders found.", 404);
        }
    }

    function getFounder(){
        $users = get_users(array(
            'role__in' => array(
                'founder'
            )
        ));

        if ($users) {
            foreach ($users as $user) {
                $user_data = get_userdata($user->ID);

                $founder = array(
                    'id' => $user_data->ID,
                    'first_name' => $user_data->first_name,
                    'last_name' => $user_data->last_name,
                    'email' => $user_data->user_email,
                    'role' => $user_data->roles,
                    'author_url' => $user_data->user_url,
                    'avatar_url' => get_avatar_url($user_data->ID, ['size' => 384])
                );

                $founders[] = $founder;
            }

            return $founders;
        } else {
            throw new Exception("No Founders found.", 404);
        }
    }
}
