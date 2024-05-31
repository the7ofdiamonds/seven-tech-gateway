<?php

namespace SEVEN_TECH\Gateway\Database;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class DatabaseExists
{
    function existsByEmail($email)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByEmail('%s')", $email)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('There was an error searching for Account.', 404);
            }

            return $results[0]->resultSet;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByUsername($username)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByUsername('%s')", $username)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('There was an error searching for Account.', 404);
            }

            return $results[0]->resultSet;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByNicename($nicename)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByNicename('%s')", $nicename)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('There was an error searching for Account.', 404);
            }

            return $results[0]->resultSet;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }

    function existsByPhone($phone)
    {
        try {
            global $wpdb;

            $results = $wpdb->get_results(
                $wpdb->prepare("CALL existsByPhone('%s')", $phone)
            );

            if ($wpdb->last_error) {
                throw new Exception("Error executing stored procedure: " . $wpdb->last_error, 500);
            }

            if (!isset($results[0])) {
                throw new Exception('There was an error searching for Account.', 404);
            }

            return $results[0]->resultSet;
        } catch (Exception $e) {
            throw new DestructuredException($e);
        }
    }
}
