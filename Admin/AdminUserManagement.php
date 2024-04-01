<?php

namespace SEVEN_TECH\Admin;

use Exception;

use SEVEN_TECH\Validator\Validator;
use SEVEN_TECH\User\User;

class AdminUserManagement
{
    private $validator;
    private $user;

    public function __construct()
    {
        add_action('admin_menu', [$this, 'register_custom_submenu_page']);
        add_action('admin_menu', [$this, 'register_section']);
        
        $this->validator = new Validator;
        $this->user = new User;
    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven_tech_admin', '', 'User', 'manage_options', 'seven_tech_user_management', [$this, 'create_section'], 4);
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
            $user = $this->user->findUserByEmail($email);

            if (!$user) {
                return "User could not be found.";
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function forgotPassword($email)
    {
        try {

            $this->validator->validEmail($email);

            // Send email
            return "An email has been sent to {$email} check your inbox for directions on how to reset your password.";
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
