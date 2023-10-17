<?php

namespace THFW\Admin;

class MissionStatement
{

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_menu_page']);
    }

    function register_custom_menu_page()
    {

        add_submenu_page('thfw_admin', 'Add Mission Statement', 'Add Mission', 'manage_options', 'orb_mission_statement', [$this, 'create_section'], 1);
        add_action('admin_init', [$this, 'register_section']);
    }

    function create_section()
    {
        include plugin_dir_path(__FILE__) . 'includes/admin-add-mission-statement.php';
    }

    function register_section()
    {

        add_settings_section('thfw-admin-about', 'Add Mission Statement', [$this, 'section_description'], 'thfw_about');
        register_setting('thfw-admin-about-group', 'mission-statement');
        add_settings_field('mission-statement', 'Add Mission Statement', [$this, 'mission_statement'], 'thfw_about', 'thfw-admin-about');
    }

    function section_description()
    {
        echo 'Add your mission statement';
    }

    function mission_statement()
    { ?>
        <textarea name="mission-statement"><?php echo esc_textarea(get_option('mission-statement')); ?></textarea>
<?php
    }
}
