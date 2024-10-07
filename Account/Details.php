<?php

namespace SEVEN_TECH\Gateway\Account;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class Details
{
    
    public function add($id,$metaKey, $metaValue) {
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

    function expireCredentials(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL expireCredentials('%s')", $email)
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

    function unexpireCredentials(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unexpireCredentials('%s')", $email)
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

    function lockAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL lockAccount('%s')", $email)
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

    function unlockAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unlockAccount('%s')", $email)
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

    function disableAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL disableAccount('%s')", $email)
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

    function enableAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL enableAccount('%s')", $email)
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

    function expireAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL expireAccount('%s')", $email)
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

    function unexpireAccount(String $email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL unexpireAccount('%s')", $email)
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
