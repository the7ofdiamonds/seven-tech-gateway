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
    public $joined;
    public $email;
    public $username;
    public $password;
    public $roles;
    public $level;
    public $profile_image;
    public $confirmation_code;
    public $first_name;
    public $last_name;
    public $nicename;
    public $phone;
    public $bio;
    public $provider_given_id;
    public $sessions;
    public $is_authenticated;
    public $is_account_non_expired;
    public $is_account_non_locked;
    public $is_credentials_non_expired;
    public $is_enabled;

    public function __construct($email = '')
    {
        $this->validator = new Validator;
        $this->Roles = new Roles;

        if ($email != '') {
            $account = $this->findAccount($email);

            $this->id = $account->id;
            $this->joined = $account->joined;
            $this->email =  $account->email;
            $this->username = $account->username;
            $this->password = $account->password;
            $this->roles =  $account->roles;
            $this->level =  $account->level;
            $this->profile_image = $account->profile_image;
            $this->confirmation_code = $account->confirmation_code;
            $this->first_name = $account->first_name;
            $this->last_name = $account->last_name;
            $this->nicename = $account->nicename;
            $this->phone = $account->phone;
            $this->provider_given_id = $account->provider_given_id;
            $this->sessions = $account->sessions;
            $this->is_authenticated = $account->is_authenticated;
            $this->is_account_non_expired = $account->is_account_non_expired;
            $this->is_account_non_locked = $account->is_account_non_locked;
            $this->is_credentials_non_expired = $account->is_credentials_non_expired;
            $this->is_enabled = $account->is_enabled;
        }
    }

    public function getSessions($id)
    {
        try {
            if (empty($id)) {
                throw new Exception('ID is required.', 400);
            }

            $account_status = get_user_meta($id, 'session_tokens');

            if (empty($account_status)) {
                return '';
            }

            if (!$account_status) {
                throw new Exception('User ID is not valid.', 400);
            }

            return $account_status[0];
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function findAccount($email)
    {
        try {
            if (empty($email)) {
                throw new Exception('Email is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Account could not be found.', 404);
            }

            $account = $results[0];
            $account->roles = $this->Roles->unserializeRoles($account->roles);
            $account->level = $this->Roles->getRolesHighestLevel($account->roles);
            $account->profile_image = get_avatar_url($account->id);
            $account->sessions = $this->getSessions($account->id);
            $account->is_authenticated = $account->is_authenticated == 1 ? 'logged in' : 'logged out';
            $account->is_account_non_expired = $account->is_account_non_expired == 1 ? true : false;
            $account->is_account_non_locked = $account->is_account_non_locked == 1 ? true : false;
            $account->is_credentials_non_expired = $account->is_credentials_non_expired == 1 ? true : false;
            $account->is_enabled = $account->is_enabled == 1 ? true : false;

            return $account;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
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

            if ($confirmationCode != $this->confirmation_code) {
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
