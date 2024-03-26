<?php

namespace SEVEN_TECH\Admin;

class Admin
{
    private $adminAccountMngmnt;

    public function __construct()
    {
        // $this->register_custom_menu_page();
        // (new AdminMissionStatement)->register_custom_submenu_page();
        // (new AdminSocialBar)->register_custom_submenu_page();

        // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);

        // add_filter('map_meta_cap', [$this, 'allow_founder_edit_capabilities'], 10, 4);

        // (new AdminAccountManagement)->deleteAccount("jamel.c.lyons@me.com");
    }

    function hide_admin_bar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
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
