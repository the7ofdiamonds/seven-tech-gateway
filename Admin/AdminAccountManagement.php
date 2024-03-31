<?php

namespace SEVEN_TECH\Admin;

use Exception;

use SEVEN_TECH\Validator\Validator;
use SEVEN_TECH\User\User;

class AdminAccountManagement
{
    private $validator;
    private $user;

    public function __construct()
    {
        $this->register_custom_submenu_page();

        $this->validator = new Validator;
        $this->user = new User;
    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven_tech_admin', '', 'Account', 'manage_options', 'seven_tech_account_management', [$this, 'create_section'], 4);
        $this->register_section();
    }

    function create_section()
    {
        include SEVEN_TECH . 'Admin/includes/admin-account-management.php';
    }

    function register_section()
    {
        add_settings_section('seven-tech-admin-account-management', 'Account Management', [$this, 'section_description'], 'seven_tech_account_management');
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

    public function lockAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            $password = $user->password;

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s', '%s')", $email, $password)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be locked at this time.');
            }

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            error_log($e->getMessage());
            return 'Error: ' . $e->getMessage();
        }
    }


    function unlockAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            global $wpdb;

            $password = $user->password;
            $confirmationCode = $user->confirmation_code;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s', '%s', '%s')", $email, $password, $confirmationCode)
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be removed at this time.');
            }

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function removeAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            global $wpdb;

            $password = $user->password;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s', '%s')", $email, $password)
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be removed at this time.');
            }

            return 'Account removed succesfully.';
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    function deleteAccount($email)
    {
        try {
            $validEmail = $this->validator->validEmail($email);

            if (!$validEmail) {
                throw new Exception('Email is not valid');
            }
// Check if user is removed first
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL deleteAccount('%s')", $email)
            );

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (empty($results[0]->result) || !$results[0]->result) {
                throw new Exception('Account could not be deleted at this time.');
            }

            return 'Account deleted succesfully.';
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}
