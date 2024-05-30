<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;
use SEVEN_TECH\Gateway\Session\Session;

use Exception;

class Account
{
    public $id;
    public $joined;
    public $user_activation_code;
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

    public function __construct($email)
    {
        try {
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
            $this->id = $account->id;
            $this->joined = $account->joined;
            $this->user_activation_code = $account->user_activation_code;
            $this->email =  $account->email;
            $this->username = $account->username;
            $this->password = $account->password;
            $this->roles =  (new Roles)->unserializeRoles($account->roles);
            $this->level =  (new Roles)->getRolesHighestLevel($this->roles);
            $this->profile_image = get_avatar_url($account->id);
            $this->confirmation_code = $account->confirmation_code;
            $this->first_name = $account->first_name;
            $this->last_name = $account->last_name;
            $this->nicename = $account->nicename;
            $this->phone = $account->phone;
            $this->provider_given_id = $account->provider_given_id;
            $this->sessions = (new Session)->getSessions($account->id);
            $this->is_authenticated = $account->is_authenticated == 1 ? 'logged in' : 'logged out';
            $this->is_account_non_expired = $account->is_account_non_expired == 1 ? true : false;
            $this->is_account_non_locked = $account->is_account_non_locked == 1 ? true : false;
            $this->is_credentials_non_expired = $account->is_credentials_non_expired == 1 ? true : false;
            $this->is_enabled = (bool) $account->is_enabled;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyAccount($password, $confirmationCode)
    {
        try {
            $validConfirmationCode = (new Validator)->validConfirmationCode($confirmationCode);

            if (!$validConfirmationCode) {
                return false;
            }

            $password = (new Validator)->validPassword($password);

            if (!$password) {
                return false;
            }

            $validEmail = (new Validator)->validEmail($this->email);

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
    public function lockAccount($password)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($password)) {
                throw new Exception('Password is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s', '%s')", $this->email, $password)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount($userActivationCode)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($userActivationCode)) {
                throw new Exception('User Activation Code is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s', '%s')", $this->email, $userActivationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be unlocked at this time.', 500);
            }

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account removed email
    function disableAccount($password)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($password)) {
                throw new Exception('Password is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s', '%s')", $this->email, $password)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return 'Account disabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    // Send account enabled email
    function enableAccount($userActivationCode)
    {
        try {

            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            if (empty($userActivationCode)) {
                throw new Exception('User Activation Code is required.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL enableAccount('%s', '%s')", $this->email, $userActivationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time.', 500);
            }

            return 'Account enabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function deleteAccount()
    {
        try {
            if (empty($this->email)) {
                throw new Exception('Email is required.', 400);
            }

            $account = new Account($this->email);

            if ($account->is_account_non_locked) {
                throw new Exception('Account must first be locked.', 400);
            }

            if ($account->is_enabled) {
                throw new Exception('Account must first be disabled.', 400);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL deleteAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be deleted at this time.', 500);
            }

            return 'Account deleted succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
