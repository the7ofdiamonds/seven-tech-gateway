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
            $user = $this->user->findUserByEmail($email);

            if (!$user) {
                return "User could not be found.";
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception($e);
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
}
