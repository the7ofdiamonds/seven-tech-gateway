<?php

namespace SEVEN_TECH\Admin;

class Admin
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_menu_page']);
        add_action('admin_menu', [(new AdminMissionStatement), 'register_custom_submenu_page']);
        add_action('admin_menu', [(new AdminSocialBar), 'register_custom_submenu_page']);
        add_action('admin_menu', [(new AdminAccountManagement), 'register_custom_submenu_page']);
        add_action('admin_menu', [(new AdminUserManagement), 'register_custom_submenu_page']);

        add_action('after_setup_theme', [$this, 'hide_admin_bar']);

        // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);

        // add_filter('map_meta_cap', [$this, 'allow_founder_edit_capabilities'], 10, 4);
    }

    public function register_custom_menu_page()
    {
        add_menu_page(
            '',
            'GATEWAY',
            'manage_options',
            'seven-tech',
            '',
            'dashicons-info',
            101
        );

        add_submenu_page(
            'seven-tech',
            'SEVEN TECH GATEWAY',
            'Dashboard',
            'manage_options',
            'seven-tech',
            [$this, 'create_section'],
            0
        );

        add_action('admin_init', [$this, 'register_section']);
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin.php';
    }

    function register_section()
    {
        add_settings_section('seven-tech-admin-group', 'SEVEN TECH DASHBOARD', '', 'seven-tech');
    }

    function hide_admin_bar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
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
