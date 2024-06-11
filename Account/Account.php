<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

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
            $this->is_authenticated = (bool) $account->is_authenticated;
            $this->is_account_non_expired = (bool) $account->is_account_non_expired;
            $this->is_account_non_locked = (bool) $account->is_account_non_locked;
            $this->is_credentials_non_expired = (bool) $account->is_credentials_non_expired;
            $this->is_enabled = (bool) $account->is_enabled;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function lockAccount($password)
    {
        try {
            (new Validator)->isValidEmail($this->email);
            (new Validator)->isValidPassword($password);

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

            (new EmailAccount)->accountLocked($this->email);

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount($userActivationCode)
    {
        try {
            (new Validator)->isValidEmail($this->email);

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

            (new EmailAccount)->accountUnlocked($this->email);

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function disableAccount($password)
    {
        try {
            (new Validator)->isValidEmail($this->email);
            (new Validator)->isValidPassword($password);

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

            (new EmailAccount)->accountDisabled($this->email);

            return 'Account disabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function enableAccount($userActivationCode)
    {
        try {
            (new Validator)->isValidEmail($this->email);

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

            (new EmailAccount)->accountEnabled($this->email);

            return 'Account enabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function deleteAccount()
    {
        try {
            (new Validator)->isValidEmail($this->email);

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

            if ($results[0]->result === 'FALSE') {
                throw new Exception('Account could not be deleted at this time.', 500);
            }

            (new EmailAccount)->accountDeleted($this->email);

            return 'Account deleted succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
