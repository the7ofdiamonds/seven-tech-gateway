<?php

namespace SEVEN_TECH\Gateway\Admin;

use SEVEN_TECH\Gateway\Change\Change;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\User\User;
use SEVEN_TECH\Gateway\User\Add;

class AdminUserManagement
{
    private $parent_slug;
    private $page_title;
    private $menu_title;
    private $menu_slug;
    public $page_url;

    public function __construct()
    {
        $this->parent_slug = (new Admin)->get_parent_slug();
        $this->page_title = 'User Management';
        $this->menu_title = 'User';
        $this->menu_slug = (new Admin)->get_menu_slug($this->page_title);
        $this->page_url = (new Admin)->get_plugin_page_url('admin.php', $this->menu_slug);

        add_action('wp_ajax_createUser', [$this, 'createUser']);
        add_action('wp_ajax_getUser', [$this, 'getUser']);
        add_action('wp_ajax_addUserRole', [$this, 'addUserRole']);
        add_action('wp_ajax_removeUserRole', [$this, 'removeUserRole']);
        add_action('wp_ajax_changeUsername', [$this, 'changeUsername']);
        add_action('wp_ajax_changeNicename', [$this, 'changeNicename']);
        add_action('wp_ajax_changeNickname', [$this, 'changeNickname']);
        add_action('wp_ajax_changeFirstName', [$this, 'changeFirstName']);
        add_action('wp_ajax_changeLastName', [$this, 'changeLastName']);
        add_action('wp_ajax_changePhoneNumber', [$this, 'changePhoneNumber']);
    }

    function register_custom_submenu_page()
    {
        add_submenu_page($this->parent_slug, $this->page_title, $this->menu_title, 'manage_options', $this->menu_slug, [$this, 'create_section'], 4);
        add_settings_section('seven_tech_gateway_admin_user_management',  $this->page_title, [$this, 'section_description'], $this->menu_slug);
    }

    function create_section()
    {
        include_once SEVEN_TECH_GATEWAY . 'Admin/includes/admin-user-management.php';
    }

    function section_description()
    {
        echo 'Manage Users';
    }

    public function createUser()
    {
        try {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $nicename = $_POST['nicename'];
            $nickname = $_POST['nickname'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $phone = $_POST['phone'];

            $createdUser = (new Add)->user($email, $username, $password, $nicename, $nickname, $firstname, $lastname, $phone);

            wp_send_json_success($createdUser);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function getUser()
    {
        try {
            $email = $_POST['email'];

            $user = new User($email);

            wp_send_json_success($user);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function addUserRole()
    {
        try {
            $id = $_POST['id'];
            $roleName = $_POST['added_role'];
            $roleDisplayName = $_POST['display_name_added'];

            $add_role = (new Roles)->addRole($id, $roleName, $roleDisplayName);

            wp_send_json_success($add_role);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    public function removeUserRole()
    {
        try {
            $id = $_POST['id'];
            $roleName = $_POST['remove_role'];
            $roleDisplayName = $_POST['display_name_remove'];

            $remove_role = (new Roles)->removeRole($id, $roleName, $roleDisplayName);

            wp_send_json_success($remove_role);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changeUsername()
    {
        try {
            $email = $_POST['email'];
            $username = $_POST['username'];

            $change_username = (new Change($email))->username($username);

            wp_send_json_success($change_username);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changeNicename()
    {
        try {
            $email = $_POST['email'];
            $nicename = $_POST['nicename'];

            $change_nicename = (new Change($email))->nicename($nicename);

            wp_send_json_success($change_nicename);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changeNickname()
    {
        try {
            $email = $_POST['email'];
            $nickname = $_POST['nickname'];

            $change_nickname = (new Change($email))->nickname($nickname);

            wp_send_json_success($change_nickname);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changeFirstName()
    {
        try {
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];

            $change_firstname = (new Change($email))->firstName($firstname);

            wp_send_json_success($change_firstname);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changeLastName()
    {
        try {
            $email = $_POST['email'];
            $lastname = $_POST['lastname'];

            $change_lastname = (new Change($email))->lastName($lastname);

            wp_send_json_success($change_lastname);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }

    function changePhoneNumber()
    {
        try {
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $change_phone = (new Change($email))->phone($phone);

            wp_send_json_success($change_phone);
        } catch (DestructuredException $e) {
            wp_send_json_error($e->getErrorMessage(), $e->getStatusCode());
        }
    }
}
