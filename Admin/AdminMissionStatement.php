<?php

namespace SEVEN_TECH\Admin;

class AdminMissionStatement
{

    public function __construct()
    {
    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven_tech_admin', 'Add Mission Statement', 'Add Mission', 'manage_options', 'seven_tech_mission_statement', [$this, 'create_section'], 1);
        $this->register_section();
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-add-mission-statement.php';
    }

    function register_section()
    {
        add_settings_section('seven-tech-admin-about', 'Add Mission Statement', [$this, 'section_description'], 'seven_tech_about');
        register_setting('seven-tech-admin-about-group', 'mission-statement');
        add_settings_field('mission-statement', 'Add Mission Statement', [$this, 'mission_statement'], 'seven_tech_about', 'seven-tech-admin-about');
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
