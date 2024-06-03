<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Email\EmailPassword;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;

class AdminPasswordManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'Password Management';
        $this->menu_title = 'Password';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);

        add_action('wp_ajax_findAuthenticationCredentials', [$this, 'findAuthenticationCredentials']);
        add_action('wp_ajax_recoverPassword', [$this, 'recoverPassword']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven_tech_gateway_admin_password_management',  $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-password-management.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    public function findAuthenticationCredentials()
    {
        try {
            $email = $_POST['email'];

            $authenticationCredentials = (new Authentication($email));

            wp_send_json_success($authenticationCredentials);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function recoverPassword()
    {
        try {
            $email = $_POST['email'];
            $message = (new EmailPassword)->recoverPassword($email);

            wp_send_json_success($message);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }
}
