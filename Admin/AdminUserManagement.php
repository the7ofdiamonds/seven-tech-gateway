<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;

use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\User\User;

class AdminUserManagement
{
    private $validator;
    private $user;
    private $css_file;
    private $js_file;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->user = new User;
        $this->css_file = 'UserManagement.css';
        $this->js_file = 'UserManagement.js';

        add_action('admin_enqueue_scripts', [$this, 'enqueue_custom_admin_scripts']);

        add_action('wp_ajax_getUser', [$this, 'getUser']);
        add_action('wp_ajax_forgotPassword', [$this, 'forgotPassword']);
        add_action('wp_ajax_changeUserNicename', [$this, 'changeUserNicename'], 10, 2);
        add_action('wp_ajax_addUserRole', [$this, 'addUserRole']);
        add_action('wp_ajax_removeUserRole', [$this, 'removeUserRole']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven-tech', '', 'User', 'manage_options', 'seven_tech_user_management', [$this, 'create_section'], 4);
        add_settings_section('seven-tech-admin-user-management', 'User Management', [$this, 'section_description'], 'seven_tech_user_management');
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-user-management.php';
    }

    function section_description()
    {
        echo 'Manage Users';
    }

    function enqueue_custom_admin_scripts($hook_suffix)
    {
        if ($hook_suffix === 'gateway_page_seven_tech_user_management') {
            wp_enqueue_style('custom-admin-style', SEVEN_TECH_URL . "Admin/includes/css/{$this->css_file}", array(), '1.0.0');
            wp_enqueue_script('custom-admin-script',  SEVEN_TECH_URL . "Admin/includes/js/{$this->js_file}", array('jquery'), '1.0.0', true);
        }
    }

    public function getUser()
    {
        try {

            if (!isset($_POST['email'])) {
                throw new Exception("Email is required.", 400);
            }

            $email = $_POST['email'];

            $user = $this->user->getUser($email);

            if (!$user) {
                throw new Exception("User could not be found.");
            }

            wp_send_json_success($user);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    // Send password recovery email
    function forgotPassword()
    {
        try {
            if (!isset($_POST['email'])) {
                throw new Exception("Email is required.", 400);
            }

            $email = $_POST['email'];
            $this->validator->validEmail($email);

            return "An email has been sent to {$email} check your inbox for directions on how to reset your password.";
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function changeUserNicename()
    {
        try {
            $id = $_POST['id'];
            $nicename = $_POST['nicename'];

            $change_nicename = $this->user->changeUserNicename($id, $nicename);

            wp_send_json_success($change_nicename);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    public function addUserRole()
    {
        try {
            $id = $_POST['id'];
            $roleName = $_POST['added_role'];
            $roleDisplayName = $_POST['display_name_added'];

            $add_role = $this->user->addUserRole($id, $roleName, $roleDisplayName);

            wp_send_json_success($add_role);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    public function removeUserRole()
    {
        try {
            $id = $_POST['id'];
            $roleName = $_POST['remove_role'];
            $roleDisplayName = $_POST['display_name_remove'];

            $remove_role = $this->user->removeUserRole($id, $roleName, $roleDisplayName);

            wp_send_json_success($remove_role);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }
}
