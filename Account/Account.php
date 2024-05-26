<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

use Exception;

class Account
{
    private $validator;
    private $Roles;

    public $id;
    public $email;
    public $username;
    public $password;
    public $roles;
    public $level;
    public $profileImage;
    public $confirmationCode;

    public function __construct($email)
    {
        $this->validator = new Validator;
        $this->Roles = new Roles;

        $this->email = $email;

        $account = $this->findAccount();

        $this->id = $account->id;
        $this->username = $account->username;
        $this->password= $account->password;
        $this->roles = $this->Roles->unserializeRoles($account->roles);
        $this->level = $this->Roles->getRolesHighestLevel($this->roles);
        $this->profileImage = get_avatar_url($account->id);
        $this->confirmationCode = $account->confirmation_code;
    }

   

    function findAccount()
    {
        try {
            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Account could not be found.', 404);
            }

            $account = $results[0];

            return $account;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function getAccountStatus()
    {
        try {
            if (empty($this->id)) {
                throw new Exception('ID is required.', 400);
            }

            $account_status = get_user_meta($this->id, 'session_tokens');

            if ($account_status == false) {
                throw new Exception('User ID is not valid.', 400);
            }

            return $account_status;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyAccount($password, $confirmationCode)
    {
        try {
            $validConfirmationCode = $this->validator->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                return false;
            }

            $password = $this->validator->validPassword($password);

            if (!$password) {
                return false;
            }

            $validEmail = $this->validator->validEmail($this->email);

            if (!$validEmail) {
                throw new Exception('Email is not valid', 400);
            }

            $password_check = wp_check_password($password, $this->password, $this->id);

            if (!$password_check) {
                return false;
            }

            if ($confirmationCode != $this->confirmationCode) {
                return false;
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account locked email
    public function lockAccount($confirmationCode)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s', '%s')", $this->email, $confirmationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount($confirmationCode)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s', '%s', '%s')", $this->email, $confirmationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || !$results[0]->resultSet) {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account removed email
    function disableAccount($confirmationCode)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s', '%s')", $this->email, $confirmationCode)
            );

            $accountDisabled = $results[0]->resultSet;

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!$accountDisabled) {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account removed succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account enabled email
    function enableAccount($confirmationCode)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL enableAccount('%s', '%s')", $this->email, $confirmationCode)
            );

            $accountDisabled = $results[0]->resultSet;

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!$accountDisabled) {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account removed succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
