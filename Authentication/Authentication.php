<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Account\Account;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;
use WP_Error;
use WP_User;
use TypeError;

class Authentication
{
    public $id;
    public string $email;
    public string $password;
    public ?string $userActivationKey;
    public ?string $confirmationCode;
    public ?string $phone;
    public ?string $providerGivenID;
    public bool $isAuthenticated;
    public bool $isAccountNonExpired;
    public bool $isAccountNonLocked;
    public bool $isCredentialsNonExpired;
    public bool $isEnabled;

    public function __construct(String $email)
    {
        try {
            $account = new Account($email);;
            $this->id = $account->id;
            $this->email = $account->email;
            $this->password = $account->password;
            $this->userActivationKey = $account->userActivationKey;
            $this->confirmationCode = $account->confirmationCode;
            $this->phone = $account->phone;
            $this->providerGivenID = $account->providerGivenID;
            $this->isAuthenticated = $account->isAuthenticated;
            $this->isAccountNonExpired = $account->isAccountNonExpired;
            $this->isAccountNonLocked = $account->isAccountNonLocked;
            $this->isCredentialsNonExpired = $account->isCredentialsNonExpired;
            $this->isEnabled = $account->isEnabled;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (TypeError $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        } 
    }

    function addProviderGivenID(String $provider_given_id): bool
    {
        try {
            $providerGivenIDAdded = add_user_meta($this->id, 'provider_given_id', $provider_given_id);

            if (!$providerGivenIDAdded) {
                throw new Exception('Account provider given ID could not be added.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateProviderGivenID(String $provider_given_id): bool
    {
        try {
            $providerGivenIDUpdated = update_user_meta($this->id, 'provider_given_id', $provider_given_id);

            if (!$providerGivenIDUpdated) {
                throw new Exception('Account provider given ID could not be updated.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function addActivationKey(): string
    {
        try {
            $userActivationKey = wp_generate_password(20, false);
            $userData = new WP_User($this->id);
            $userData->user_activation_key = $userActivationKey;
            $updatedUser = wp_update_user($userData);

            if (is_wp_error($updatedUser)) {
                $all_error_messages = $updatedUser->get_error_messages();
                foreach ($all_error_messages as $message) {
                    error_log("Error: " . $message);
                    throw new Exception($message, 500);
                }
            }

            return $userActivationKey;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateActivationKey() : string
    {
        try {
            return $this->addActivationKey();
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function addConfirmationCode(): string
    {
        try {
            $confirmation_code = wp_generate_password(20, false);
            $confirmationCodeAdded = add_user_meta($this->id, 'confirmation_code', $confirmation_code);

            if (!$confirmationCodeAdded) {
                throw new Exception('Account confirmation code could not be added.', 500);
            }

            return $confirmation_code;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateConfirmationCode(): string
    {
        try {
            $confirmation_code = wp_generate_password(20, false);
            $confirmationCodeUpdated = update_user_meta($this->id, 'confirmation_code', $confirmation_code);

            if (!$confirmationCodeUpdated) {
                throw new Exception('Account confirmation code could not be updated.', 500);
            }

            return $confirmation_code;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyAccount(String $userActivationKey): bool
    {
        try {
            $matches = (new Validator)->matches($userActivationKey, $this->userActivationKey);

            if (!$matches) {
                throw new Exception("User Activation Key provided does not match our records.", 403);
            }

            return $matches;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyCredentials(String $confirmation_code): bool
    {
        try {
            (new Validator)->isValidConfirmationCode($confirmation_code);

            $matches = (new Validator)->matches($confirmation_code, $this->confirmationCode);

            if (!$matches) {
                throw new Exception("Confirmation code provided does not match our records.", 403);
            }

            return $matches;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
