<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;
use WP_Error;
use WP_User;

class Authentication
{
    public $id;
    public $email;
    public $password;
    public $userActivationKey;
    public $confirmationCode;
    public $phone;
    public $provider_given_id;

    public function __construct(String $email)
    {
        try {
            (new DatabaseExists)->existsByEmail($email);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL findUserByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('Authentication credentials could not be found.', 404);
            }

            $auth = $results[0];
            $this->id = $auth->id;
            $this->email = $auth->email;
            $this->password = $auth->password;
            $this->userActivationKey = $auth->user_activation_key;
            $this->confirmationCode = $auth->confirmation_code;
            $this->phone = $auth->phone;
            $this->provider_given_id = $auth->provider_given_id;
        } catch (DestructuredException $e) {
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
