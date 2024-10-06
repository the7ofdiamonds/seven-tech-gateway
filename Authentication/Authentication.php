<?php

namespace SEVEN_TECH\Gateway\Authentication;

use SEVEN_TECH\Gateway\Database\DatabaseExists;
use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Password\Password;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Authentication
{
    public $id;
    public $email;
    public $password;
    public $activation_code;
    public $confirmation_code;
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
            $this->activation_code = $auth->activation_code;
            $this->confirmation_code = $auth->confirmation_code;
            $this->phone = $auth->phone;
            $this->provider_given_id = $auth->provider_given_id;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isAuthenticated($password = '')
    {
        try {
            if ($password !== '') {
                (new Password)->passwordMatchesHash($password, $this->password);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL isAuthenticated('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be logged in.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isNotAuthenticated()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL isNotAuthenticated('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be logged out.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function verifyCredentials($confirmation_code)
    {
        try {
            (new Validator)->isValidConfirmationCode($confirmation_code);

            $matches = (new Validator)->matches($confirmation_code, $this->confirmation_code);

            if (!$matches) {
                throw new Exception("Confirmation code provided does not match our records.", 403);
            }

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL verifyCredentials('%s', '%s')", $this->email, $this->confirmation_code)
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

    function addProviderGivenID(String $provider_given_id) {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addProviderGivenID('%s', '%s')", $this->email, $provider_given_id)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

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

            return true;
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

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function addActivationCode()
    {
        try {
            $activation_code = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addActivationCode('%s', '%s')", $this->email, $activation_code)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account confirmation code could not be logged in.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function updateActivationCode()
    {
        try {
            $activation_code = wp_generate_password(20, false);

            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL updateActivationCode('%s', '%s')", $this->email, $activation_code)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account confirmation code could not be logged in.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
