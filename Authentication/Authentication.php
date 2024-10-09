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

    public function __construct($email)
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

    function addActivationKey()
    {
        try {
            $userActivationKey = wp_generate_password(20, false);
            $userData = new WP_User($this->id);
            $userData->user_activation_key = $userActivationKey;
            $updatedUser = wp_update_user($userData);

            if ($updatedUser !== $this->id) {
                throw new Exception("User Activation Key could not be added.", 500);
            }

            return $userActivationKey;
        } catch (WP_Error $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateActivationKey()
    {
        try {
            return $this->addActivationKey();
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyCredentials(String $confirmation_code)
    {
        try {
            (new Validator)->isValidConfirmationCode($confirmation_code);

            $matches = (new Validator)->matches($confirmation_code, $this->confirmationCode);

            if (!$matches) {
                throw new Exception("Confirmation code provided does not match our records.", 403);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL verifyCredentials('%s', '%s')", $this->email, $this->confirmationCode)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception("There was an error verifying your credentials please try again at another time.", 500);
            }

            return true;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function addProviderGivenID(String $provider_given_id)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addProviderGivenID('%s', '%s')", $this->email, $provider_given_id)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            error_log($results[0]->resultSet);
            
            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account confirmation code could used.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function addConfirmationCode()
    {
        try {
            $confirmation_code = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addConfirmationCode('%s', '%s')", $this->email, $confirmation_code)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account confirmation code could used.', 500);
            }

            return $confirmation_code;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateConfirmationCode()
    {
        try {
            $confirmation_code = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL updateConfirmationCode('%s', '%s')", $this->email, $confirmation_code)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account confirmation code could used.', 500);
            }

            return $confirmation_code;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
