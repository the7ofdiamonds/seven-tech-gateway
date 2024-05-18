<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;

use SEVEN_TECH\Gateway\User\User;

class AdminUserManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;
    private $user;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'User Management';
        $this->menu_title = 'User';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);
        $this->user = new User;

        add_action('wp_ajax_getUser', [$this, 'getUser']);
        add_action('wp_ajax_forgotPassword', [$this, 'forgotPassword']);
        add_action('wp_ajax_changeUserNicename', [$this, 'changeUserNicename'], 10, 2);
        add_action('wp_ajax_addUserRole', [$this, 'addUserRole']);
        add_action('wp_ajax_removeUserRole', [$this, 'removeUserRole']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven-tech-admin-user-management',  $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-user-management.php';
    }

    function section_description()
    {
        echo 'Manage Users';
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
            // $this->validator->validEmail($email);

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
