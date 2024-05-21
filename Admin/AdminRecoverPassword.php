<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Password\Password;

use Exception;

class AdminRecoverPassword
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $password;

    public function __construct(Password $password)
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Password Management';
        $this->menu_title = 'Password';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->password = $password;

        add_action('wp_ajax_recoverPassword', [$this, 'recoverPassword']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven_tech_gateway_admin_recover_password',  $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-recover-password.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    // Send password recovery email
    function recoverPassword()
    {
        try {
            if (!isset($_POST['email'])) {
                throw new Exception('Email is required.', 400);
            }

            $email = $_POST['email'];

            $message = $this->password->recoverPassword($email);

            wp_send_json_success($message);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage(), $e->getCode());
        }
    }
}
