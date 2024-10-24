<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Authentication\Authentication;
use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Authentication\Logout;
use SEVEN_TECH\Gateway\Validator\Validator;
use SEVEN_TECH\Gateway\Roles\Roles;

use SEVEN_TECH\Communications\Email\Gateway\Account as GatewayAccount;

use Exception;
use TypeError;

class Account
{
    public int $id;
    public String $joined;
    public ?String $userActivationKey = "";
    public String $email;
    public String $username;
    public String $password;
    public array $roles;
    public String $level;
    public ?String $profileImage;
    public ?String $confirmationCode = "";
    public String $firstName;
    public String $lastName;
    public String $nickname;
    public String $nicename;
    public ?String $phone = "";
    public String $bio;
    public ?String $providerGivenID = "";
    public bool $isAuthenticated;
    public bool $isAccountNonExpired;
    public bool $isAccountNonLocked;
    public bool $isCredentialsNonExpired;
    public bool $isEnabled;

    public function __construct(string $email)
    {
        try {
            (new DatabaseExists)->existsByEmail($email);

            $this->email = $email;
            $account = $this->find();
            $this->id = $account->id;
            $this->joined = $account->joined;
            $this->email =  $account->email;
            $this->username = $account->username;
            $this->password = $account->password;
            $this->firstName = $account->first_name;
            $this->lastName = $account->last_name;
            $this->nicename = $account->nicename;
            $this->nickname = $account->nickname;
            $this->phone = $account->phone;
            $this->userActivationKey = $account->user_activation_key;
            $this->confirmationCode = $account->confirmation_code;
            $this->providerGivenID = $account->provider_given_id;
            $this->isAuthenticated = (int) $account->is_authenticated == 1;
            $this->isAccountNonExpired = (int) $account->is_account_non_expired == 1;
            $this->isAccountNonLocked = (int) $account->is_account_non_locked == 1;
            $this->isCredentialsNonExpired = (int) $account->is_credentials_non_expired == 1;
            $this->isEnabled = (int) $account->is_enabled == 1;
            $this->roles = (new Roles)->unserializeRoles($account->roles);
            $this->level = (new Roles)->getRolesHighestLevel($this->roles);
            $this->profileImage = get_avatar_url($account->id);
        } catch (TypeError $e) {
            throw new DestructuredException($e);
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function find()
    {
        try {
            (new Validator)->isValidEmail($this->email);

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

            return $results[0];
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function activate(String $userActivationKey): bool
    {
        try {

            if (empty($userActivationKey)) {
                throw new Exception('User Activation Key is required.', 400);
            }

            $validuserActivationKey = (new Validator())->matches($userActivationKey, $this->userActivationKey);

            if (!$validuserActivationKey) {
                throw new Exception('User Activation Key not valid.', 400);
            }

            $accountActivated = $this->activated();

            if (!$accountActivated) {
                throw new Exception('Account could not be activated.', 500);
            }

            (new Authentication($this->email))->updateActivationKey();

            if (class_exists(GatewayAccount::class, true)) {
                (new GatewayAccount())->sendSignUpEmail($this->id);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }


    public function lock()
    {
        try {
            $accountLocked = (new Details())->lockAccount($this);

            if (!$accountLocked) {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            (new Logout)->all($this);

            if (class_exists(GatewayAccount::class, true)) {
                (new GatewayAccount())->sendAccountLockedEmail($this->id);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlock($userConfirmationKey)
    {
        try {
            (new Authentication($this->email))->verifyAccount($userConfirmationKey);

            $accountUnlocked = (new Details())->unlockAccount($this);

            if (!$accountUnlocked) {
                throw new Exception('Account could not be unlocked at this time.', 500);
            }

            (new Authentication($this->email))->updateActivationKey();

            if (class_exists(GatewayAccount::class, true)) {
                (new GatewayAccount())->sendAccountUnlockedEmail($this->id);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    public function activated()
    {
        try {

            if (!$this->isAuthenticated) {
                (new Details())->isAuthenticated($this);
            }

            if (!$this->isAccountNonLocked) {
                (new Details())->unlockAccount($this);
            }

            if (!$this->isCredentialsNonExpired) {
                (new Details())->unexpireCredentials($this);
            }

            if (!$this->isEnabled) {
                (new Details())->enableAccount($this);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function recover($userActivationKey)
    {
        try {
            (new Authentication($this->email))->verifyAccount($userActivationKey);

            $accountRecovered = $this->activated();

            if (!$accountRecovered) {
                throw new Exception('Account could not be recovered at this time.', 500);
            }

            (new Authentication($this->email))->updateActivationKey();

            if (class_exists(GatewayAccount::class, true)) {
                (new GatewayAccount())->sendAccountRecoveredEmail($this->id);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
