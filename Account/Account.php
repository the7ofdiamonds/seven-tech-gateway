<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Email\EmailAccount;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

use Exception;

class Account
{
    public int $id;
    public String $joined;
    public String $userActivationKey;
    public String $email;
    public String $username;
    public String $password;
    public array $roles;
    public String $level;
    public String $profileImage;
    public String $confirmationCode;
    public String $firstName;
    public String $lastName;
    public String $nicename;
    public String $phone = "";
    public String $bio;
    public String $providerGivenID;
    public bool $isAuthenticated;
    public bool $isAccountNonExpired;
    public bool $isAccountNonLocked;
    public bool $isCredentialsNonExpired;
    public bool $isEnabled;

    public function __construct($email)
    {
        try {
            (new Validator)->isValidEmail($email);

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
            $this->email =  $account->email ? : '';
            $this->username = $account->username ? : '';
            $this->password = $account->password ? : '';
            $this->firstName = $account->first_name ? : '';
            $this->lastName = $account->last_name ? : '';
            $this->nicename = $account->nicename ? : '';
            $this->phone = $account->phone ? : '';
            $this->userActivationKey = $account->user_activation_key ? : '';
            $this->confirmationCode = $account->confirmation_code ? : '';
            $this->providerGivenID = $account->provider_given_id ? : '';
            $this->isAuthenticated = (bool) $account->is_authenticated ? : null;
            $this->isAccountNonExpired = (bool) $account->is_account_non_expired ? : null;
            $this->isAccountNonLocked = (bool) $account->is_account_non_locked ? : null;
            $this->isCredentialsNonExpired = (bool) $account->is_credentials_non_expired ? : null;
            $this->isEnabled = (bool) $account->is_enabled ? : null;
            $this->roles = (new Roles)->unserializeRoles($account->roles);
            $this->level = (new Roles)->getRolesHighestLevel($this->roles);
            $this->profileImage = get_avatar_url($account->id);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function activate(String $userActivationCode) : bool
    {
        try {
            if (empty($userActivationCode)) {
                throw new Exception('User Activation Code is required.', 400);
            }

            if ($userActivationCode !== $this->userActivationKey) {
                throw new Exception('User Activation Code not valid.', 400);
            }

            (new Authentication($this->email))->updateActivationKey();

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function lock($confirmationCode)
    {
        try {
            (new Authentication($this->email))->verifyCredentials($confirmationCode);

            $accountLocked = (new Details($this->email))->lockAccount();

            if (!$accountLocked) {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            (new EmailAccount)->accountLocked($this->email);

            return 'Account has been locked successfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlock($confirmationCode)
    {
        try {
            (new Authentication($this->email))->verifyCredentials($confirmationCode);

            $accountUnlocked = (new Details($this->email))->unlockAccount();

            if (!$accountUnlocked) {
                throw new Exception('Account could not be unlocked at this time.', 500);
            }

            (new EmailAccount)->accountUnlocked($this->email);

            return 'Account has been unlocked succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function disable($confirmationCode)
    {
        try {
            (new Authentication($this->email))->verifyCredentials($confirmationCode);

            $accountDisable = (new Details($this->email))->disableAccount();

            if (!$accountDisable) {
                throw new Exception('Account could not be disabled at this time.', 500);
            }

            (new EmailAccount)->accountDisabled($this->email);

            return 'Account disabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function enable($confirmationCode)
    {
        try {
            (new Authentication($this->email))->verifyCredentials($confirmationCode);

            $accountEnabled = (new Details($this->email))->enableAccount();

            if (!$accountEnabled) {
                throw new Exception('Account could not be enabled at this time123.', 500);
            }

            (new EmailAccount)->accountEnabled($this->email);

            return 'Account enabled succesfully.';
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
