<?php

namespace SEVEN_TECH\Gateway\Database;

use SEVEN_TECH\Gateway\Exception\DestructuredException;

use Exception;

class DatabaseExists
{
    function existsByEmail($email)
    {
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
    }

    function existsByUsername($username)
    {
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
    }

    function existsByNicename($nicename)
    {
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
    }

    function existsByPhone($phone)
    {
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
    }
}
