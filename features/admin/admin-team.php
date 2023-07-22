<?php

class THFW_Admin_Team 
{

    public function __construct() {
        add_action( 'admin_menu', [$this, 'register_custom_menu_page'] );
    }

    function register_custom_menu_page() {

        add_submenu_page( 'thfw_edit_hero', 'Add Team', 'Add Team', 'manage_options', 'thfw_admin_team', [$this, 'create_section'] );

        add_action( 'admin_init', [$this, 'register_section'] );
    }

    function create_section() {
        include 'includes/admin-add-team.php';
    }

    function register_section() {

        add_settings_section('thfw-admin-team', 'Edit Team Member', [$this, 'section_description'], 'thfw_admin_team' );
    }

    function section_description() {
        echo 'Add, delete or update team members.';
    }
}