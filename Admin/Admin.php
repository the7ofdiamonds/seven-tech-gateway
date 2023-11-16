<?php

namespace SEVEN_TECH\Admin;

class Admin
{
    public function __construct()
    {
        // add_action('admin_menu', [$this, 'register_custom_menu_page']);

        // add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_styles']);

        new AdminMissionStatement;
        new AdminSocialBar;
    }

    function register_custom_menu_page(){
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
}
