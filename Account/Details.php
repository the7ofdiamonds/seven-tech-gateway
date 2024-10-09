<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;
use SEVEN_TECH\Gateway\Validator\Validator;

use Exception;

class Details
{
    private String $email;

    public function __construct($email)
    {
        try {
            (new Validator)->isValidEmail($email);

            $this->email = $email;
        } catch (DestructuredException $e) {
            throw new DestructuredException($e);
        } 
    }

    public function addDetails($id, $metaKey, $metaValue) : bool {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL addUserMeta('%s', '%s', '%s')", $id, $metaKey, $metaValue)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }
            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function isAuthenticated()
    {
        try {
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

    function expireCredentials()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL expireCredentials('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Password could not be updated at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unexpireCredentials()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unexpireCredentials('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function lockAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be locked at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unlockAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be unlocked at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function disableAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be removed at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function enableAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL enableAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time123.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function expireAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL expireAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function unexpireAccount()
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unexpireAccount('%s')", $this->email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (empty($results[0]->resultSet) || $results[0]->resultSet === 'FALSE') {
                throw new Exception('Account could not be enabled at this time.', 500);
            }

            return true;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
