<?php

namespace SEVEN_TECH\Admin;

use Exception;

use SEVEN_TECH\User\User;

class AdminAccountManagement
{
    private $user;

    public function __construct()
    {
        $this->user = new User;
    }

    function register_custom_submenu_page()
    {
        add_submenu_page('seven-tech', '', 'Account', 'manage_options', 'seven_tech_account_management', [$this, 'create_section'], 4);
        add_settings_section('seven-tech-admin-account-management', 'Account Management', [$this, 'section_description'], 'seven_tech_account_management');
    }

    function create_section()
    {
        include_once SEVEN_TECH . 'Admin/includes/admin-account-management.php';
    }

    function section_description()
    {
        echo 'Manage User Accounts';
    }

// Send account locked email
    public function lockAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            if ($user == '') {
                error_log("User could not be found.");
                return "User could not be found.";
            }

            $user_id = $user->id;

            $accountLocked = add_user_meta($user_id, 'is_account_non_locked', 0, true);

            if (is_int($accountLocked)) {
                return 'Account removed succesfully.';
            }

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

            if ($user == '') {
                error_log("User could not be found.");
                return "User could not be found.";
            }

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
    
// Send account removed email
    function removeAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            if ($user == '') {
                error_log("User could not be found.");
                return "User could not be found.";
            }

            $user_id = $user->id;

            $accountDisabled = add_user_meta($user_id, 'is_enabled', 0, true);

            if (is_int($accountDisabled)) {
                return 'Account removed succesfully.';
            }

            $password = $user->password;

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s', '%s')", $email, $password)
            );

            $accountDisabled = $results[0]->resultSet;

            if ($wpdb->last_error) {
                error_log("Error executing stored procedure: " . $wpdb->last_error);
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
            }

            if (!$accountDisabled) {
                throw new Exception('Account could not be removed at this time.');
            }

            return 'Account removed succesfully.';
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    // Send Account deleted email
    function deleteAccount($email)
    {
        try {
            $user = $this->user->findUserByEmail($email);

            if ($user == '') {
                error_log("User could not be found.");
                return "User could not be found.";
            }

            $is_enabled = $user->is_enabled;

            if (!is_numeric($is_enabled) || $is_enabled == 1) {
                error_log('User must first be removed.');
                return 'User must first be removed.';
            }

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
