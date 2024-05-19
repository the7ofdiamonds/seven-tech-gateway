<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;

use SEVEN_TECH\Gateway\Account\Account;

class Admin
{
    public $admin_url;

    public function __construct()
    {
        $this->admin_url = $this->get_plugin_page_url('admin.php', $this->get_parent_slug());
    }

    public function get_parent_slug()
    {
        return strtolower(str_replace(' ', '-', PLUGIN_NAME));
    }

    function get_plugin_page_url($filename, $slug)
    {
        $plugin_page_url = admin_url("{$filename}?page={$slug}");

        return $plugin_page_url;
    }

    public function settings_link($links)
    {
        $settings_link = "<a href='{$this->admin_url}'>Settings</a>";
        array_push($links, $settings_link);

        return $links;
    }

    function get_menu_slug($title)
    {
        $slug = strtolower(str_replace(' ', '-', $title));
        $menu_slug = "{$this->get_parent_slug()}-{$slug}";

        return $menu_slug;
    }

    public function register_custom_menu_page()
    {
        add_menu_page(
            PLUGIN_NAME,
            'GATEWAY',
            'manage_options',
            $this->get_parent_slug(),
            '',
            'dashicons-info',
            101
        );
        add_submenu_page(
            $this->get_parent_slug(),
            PLUGIN_NAME,
            'Dashboard',
            'manage_options',
            $this->get_parent_slug(),
            [$this, 'create_section'],
            0
        );
        add_settings_section('seven_tech_admin_group', PLUGIN_NAME, '', $this->get_parent_slug());
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }
}
