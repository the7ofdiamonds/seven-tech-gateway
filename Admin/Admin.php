<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;

use SEVEN_TECH\Gateway\Account\Account;

class Admin
{
    private $account;
    private $css_file;
    private $js_file;

    public function __construct()
    {
        $this->account = new Account;
        $this->css_file = 'Management.css';
        $this->js_file = 'Management.js';

        add_action('admin_enqueue_scripts', [$this, 'enqueue_custom_admin_scripts']);

        add_action('wp_ajax_createAccount', [$this, 'createAccount']);

        add_action('admin_menu', [$this, 'register_custom_menu_page']);
        add_action('admin_menu', [(new AdminAccountManagement), 'register_custom_submenu_page']);
        add_action('admin_menu', [(new AdminUserManagement), 'register_custom_submenu_page']);

        add_action('after_setup_theme', [$this, 'hide_admin_bar']);
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
        add_settings_section('seven-tech-admin-group', 'SEVEN TECH DASHBOARD', '', 'seven-tech');
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-management.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    function enqueue_custom_admin_scripts($hook_suffix)
    {
        if ($hook_suffix === 'toplevel_page_seven-tech') {
            wp_enqueue_style('custom-admin-style', SEVEN_TECH_URL . "Admin/includes/css/{$this->css_file}", array(), '1.0.0');
            wp_enqueue_script('custom-admin-script',  SEVEN_TECH_URL . "Admin/includes/js/{$this->js_file}", array('jquery'), '1.0.0', true);
        }
    }

    public function createAccount()
    {
        try {
            if (!isset($_POST['email'])) {
                throw new Exception("Email is required.", 400);
            }

            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nicename = $_POST['nicename'];
            $nickname = $_POST['nickname'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];
            $roles = $_POST['roles'];

            $account = $this->account->createAccount($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone, $roles);

            if ($account == '') {
                throw new Exception("User could not be found.");
            }

            wp_send_json_success($account);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    function hide_admin_bar()
    {
        if (!current_user_can('administrator') && !is_admin()) {
            show_admin_bar(false);
        }
    }
}
