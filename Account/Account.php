<?php

namespace SEVEN_TECH\Gateway\Account;

use Exception;

use SEVEN_TECH\Gateway\Validator\Validator;

class Account
{
    private $validator;

    public function __construct()
    {
        $this->validator = new Validator;
    }

    function findAccount($email)
    {
        global $wpdb;

        $results = $wpdb->get_results(
            $wpdb->prepare("CALL findUserByEmail('%s')", $email)
        );

        if ($wpdb->last_error) {
            throw new Exception("Error executing stored procedure: " . $wpdb->last_error);
        }

        $account = $results[0];

        if (empty($account)) {
            return '';
        }

        return $account;
    }

    function getAccountStatus($id)
    {
        $account_status = get_user_meta($id, 'session_tokens');

        if ($account_status == false) {
            throw new Exception('User ID is not valid.', 400);
        }

        return $account_status;
    }

    function verifyAccount($email, $password, $confirmationCode)
    {
        $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

        if (!$validConfirmationCode) {
            return false;
        }

        $password = $this->validator->validPassword($password);

        if (!$password) {
            return false;
        }

        $validEmail = $this->validator->validEmail($email);

        if (!$validEmail) {
            throw new Exception('Email is not valid', 400);
        }

        $account = $this->findAccount($email);

        $password_check = wp_check_password($password, $account->password, $account->id);

        if (!$password_check) {
            return false;
        }

        if ($confirmationCode != $account->confirmationCode) {
            return false;
        }

        return true;
    }

    // Send account locked email
    public function lockAccount($email)
    {
        try {
            $user = $this->findAccount($email);

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
            $user = $this->findAccount($email);

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
            $user = $this->findAccount($email);

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
            $user = $this->findAccount($email);

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
