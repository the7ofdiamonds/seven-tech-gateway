<?php

namespace SEVEN_TECH\Gateway\Admin;

use Exception;

use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\User\User;

class AdminUserManagement
{
    private $validator;
    private $user;

    public function __construct()
    {
        $this->validator = new Validator;
        $this->user = new User;

        add_action('wp_ajax_getUser', [$this, 'getUser']);
        add_action('wp_ajax_getUserRoles', [$this, 'getUserRoles']);

    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven-tech', '', 'User', 'manage_options', 'seven_tech_user_management', [$this, 'create_section'], 4);
        $this->register_section();
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-user-management.php';
    }

    function register_section()
    {
        add_settings_section('seven-tech-admin-user-management', 'User Management', [$this, 'section_description'], 'seven_tech_user_management');
    }

    function section_description()
    {
        echo 'Manage Users';
    }

    public function getUser($email)
    {
        try {
            $email = $_POST['emailGU'];

            $user = $this->user->findUserByEmail($email);

            if (!$user) {
                wp_send_json_error("User could not be found.");
            }

            wp_send_json_success($user);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    // Send password recovery email
    function forgotPassword($email)
    {
        try {

            $this->validator->validEmail($email);

            return "An email has been sent to {$email} check your inbox for directions on how to reset your password.";
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function changeUserNicename($email, $nicename)
    {
        $user = $this->user->findUserByEmail($email);

        if (empty($user)) {
            // Show error in admin area
            error_log('User could not be found.');
            return '';
        }

        return $this->user->changeUserNicename($user->id, $nicename);
    }

    public function addUserRole($email, $roleName, $roleDisplayName)
    {
        $user = $this->user->findUserByEmail($email);

        if (empty($user)) {
            // Show error in admin area
            error_log('User could not be found.');
            return '';
        }

        return $this->user->addUserRole($user->id, $roleName, $roleDisplayName);
    }

    public function getUserRoles($id)
    {
        try {
            $id = $_POST['id'];

            $user_roles = $this->user->getUserRoles($id);

            if (!is_array($user_roles)) {
                wp_send_json_error("User could not be found.");
            }

            wp_send_json_success($user_roles);
        } catch (Exception $e) {
            wp_send_json_error($e->getMessage());
        }
    }

    public function removeUserRole($email, $roleName, $roleDisplayName)
    {
        $user = $this->user->findUserByEmail($email);

        if (empty($user)) {
            // Show error in admin area
            error_log('User could not be found.');
            return '';
        }

        return $this->user->removeUserRole($user->id, $roleName, $roleDisplayName);
    }
}
