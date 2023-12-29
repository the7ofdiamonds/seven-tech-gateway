<?php

namespace SEVEN_TECH\Admin;

use SEVEN_TECH\Post_Types\Founders\PostTypeFounders;

class Admin
{
    public function __construct()
    {
        // add_action('admin_menu', [$this, 'register_custom_menu_page']);

        // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);

        add_filter('map_meta_cap', [$this, 'allow_founder_edit_capabilities'], 10, 4);

        new AdminMissionStatement;
        new AdminSocialBar;

        new PostTypeFounders;
    }

    function register_custom_menu_page()
    {
        add_menu_page(
            'SEVEN TECH',
            'SEVEN TECH',
            'manage_options',
            'seven_tech_admin',
            '',
            'dashicons-info',
            3
        );
    }

    function allow_founder_edit_capabilities($caps, $cap, $user_id, $args)
    {
        if ($cap === 'edit_post' || $cap === 'delete_post') {
            $post_id = isset($args[0]) ? $args[0] : 0;

            if ($post_id && get_post_type($post_id) === 'founders') {
                $user = get_userdata($user_id);

                if ($user && (in_array('founder', (array)$user->roles)) | (in_array('administrator', (array)$user->roles))) {
                    if ($post_id && get_post_field('post_author', $post_id) == $user_id) {
                        return array('exist');
                    } else {
                        return array('do_not_allow');
                    }
                } else {
                    return array('do_not_allow');
                }
            }
        }
        return $caps;
    }
}
